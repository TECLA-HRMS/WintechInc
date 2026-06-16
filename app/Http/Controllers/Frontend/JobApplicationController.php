<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    /**
     * Show the job application form
     * Display apply form with auto-filled user data
     */
    public function showApplyForm($jobId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to apply for jobs');
        }

        // Get job details
        $job = DB::table('managejobs')
            ->where('id', $jobId)
            ->whereRaw('LOWER(status) = ?', ['open'])
            ->first();

        if (!$job) {
            abort(404, 'Job not found or no longer open');
        }

        // Get authenticated user
        $user = Auth::user();

        // Check if user has already applied for this job
        $existingApplication = DB::table('job_applications')
            ->where('user_id', $user->id)
            ->where('job_id', $jobId)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this job');
        }

        return view('site.job.apply', compact('job', 'user'));
    }

    /**
     * Get user data as JSON for AJAX auto-fill
     * Return user profile data for form auto-fill
     */
    public function getUserData()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        return response()->json([
            'first_name' => $user->first_name ?? '',
            'last_name' => $user->last_name ?? '',
            'email' => $user->email ?? '',
            'phone' => $user->phone ?? '',
            'gender' => $user->gender ?? '',
            'address' => $user->address ?? '',
            'location' => $user->location ?? '',
            'pincode' => $user->pincode ?? '',
            'resume' => $user->resume ?? '',
        ]);
    }

    /**
     * Store job application
     * Save application to job_applications table
     */

    
    public function store(Request $request, $jobId)
    {
        // Validate input (preferred_work_mode_ref is intentionally NOT validated - for reference only)
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'nullable|string|max:255',
            'experience' => 'required|string|max:100',
            'notice_period' => 'nullable|string|max:100',
            'current_ctc' => 'nullable|string|max:100',
            'expected_ctc' => 'required|string|max:100',
            'linkedin' => 'nullable|url|max:255',
            'cover_letter' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Get preferred_work_mode_ref for logging only (NOT stored in database)
        $preferredWorkMode = $request->input('preferred_work_mode_ref', 'Not specified');

        $user = Auth::user();

        // Check if job exists
        $job = DB::table('managejobs')
            ->where('id', $jobId)
            ->whereRaw('LOWER(status) = ?', ['open'])
            ->first();
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'This job is no longer open for applications.');
        }

        // Check if already applied
        $existingApplication = DB::table('job_applications')
            ->where('user_id', $user->id)
            ->where('job_id', $jobId)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this job');
        }

        try {
            $resumeFile = null;

            // Handle resume upload
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $filename = 'resume_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                
                // Ensure folder exists
                if (!file_exists(public_path('applications'))) {
                    mkdir(public_path('applications'), 0777, true);
                }

                $file->move(public_path('applications'), $filename);
                $resumeFile = 'applications/' . $filename;
            } elseif ($user && $user->resume) {
                $resumeFile = 'resume/' . $user->resume;
            } else {
                return redirect()->back()->with('error', 'Please upload a resume or add one to your profile to apply.');
            }

            // Insert application into database (preferred_work_mode_ref is NOT included)
            $applicationId = DB::table('job_applications')->insertGetId([
                'user_id' => $user->id,
                'job_id' => $jobId,
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'location' => $validated['location'] ?? null,
                'experience' => $validated['experience'],
                'notice_period' => $validated['notice_period'] ?? null,
                'current_ctc' => $validated['current_ctc'] ?? null,
                'expected_ctc' => $validated['expected_ctc'],
                'linkedin' => $validated['linkedin'] ?? null,
                'cover_letter' => $validated['cover_letter'] ?? null,
                'resume' => $resumeFile,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Log application with preferred work mode (for reference only - NOT stored in DB)
            Log::info('Job application submitted', [
                'application_id' => $applicationId,
                'user_id' => $user->id,
                'job_id' => $jobId,
                'job_title' => $job->job_title ?? 'N/A',
                'applicant_name' => $validated['full_name'],
                'applicant_email' => $validated['email'],
                'preferred_work_mode' => $preferredWorkMode, // Logged but NOT stored in database
                'experience' => $validated['experience'],
                'expected_ctc' => $validated['expected_ctc'],
                'timestamp' => now()->toDateTimeString(),
            ]);

            return redirect()->back()->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            Log::error('Job application error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to submit application. Please try again.');
        }
    }

    /**
     * Check if user is logged in (for AJAX)
     * Return authentication status
     */
    public function checkAuth()
    {
        return response()->json([
            'authenticated' => Auth::check(),
            'user' => Auth::user() ? [
                'id' => Auth::user()->id,
                'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            ] : null,
        ]);
    }

    /**
     * Display user's applied jobs with status
     */
    public function myApplications()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to view your applications');
        }

        $applications = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->where('job_applications.user_id', Auth::id())
            ->select(
                'job_applications.*',
                'managejobs.job_title',
                'managejobs.company_name',
                'managejobs.job_location',
                'managejobs.job_type',
                'managejobs.company_logo'
            )
            ->orderBy('job_applications.created_at', 'desc')
            ->paginate(10);

        return view('site.job.my-applications', compact('applications'));
    }
}
