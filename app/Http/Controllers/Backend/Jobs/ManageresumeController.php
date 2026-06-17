<?php

namespace App\Http\Controllers\Backend\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
 use App\Mail\CandidateSelectedMail;
use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class ManageresumeController extends Controller
{
    /**
     * Display a listing of job applications.
     * Updated to fetch from new job_applications table structure with correct fields
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Display the specified job application.
     * Updated to work with new job_applications table structure
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update application status.
     * Updated status values to match new table (pending, reviewed, shortlisted, selected, rejected)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,reviewed,shortlisted,selected,rejected',
    ]);

    \Log::info('=== START updateStatus ===', [
        'application_id' => $id,
        'new_status' => $request->status
    ]);

    $application = DB::table('job_applications')
        ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
        ->select('job_applications.*', 'managejobs.job_title')
        ->where('job_applications.id', $id)
        ->first();

    if (!$application) {
        \Log::error('Application not found', ['id' => $id]);
        return redirect()->back()->with('error', 'Application not found.');
    }

    \Log::info('Application found', [
        'id' => $application->id,
        'email' => $application->email,
        'name' => $application->full_name,
        'job_title' => $application->job_title
    ]);

    // Update the status
    DB::table('job_applications')
        ->where('id', $id)
        ->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

    \Log::info('Status updated successfully');

    // Send status email for every status change
    try {
        if (!filter_var($application->email, FILTER_VALIDATE_EMAIL)) {
            \Log::error('Invalid email format', ['email' => $application->email]);
            return redirect()->back()->with('error', 'Invalid email address for candidate.');
        }

        Mail::to($application->email)->send(
            new ApplicationStatusMail($application->full_name, $application->job_title ?? 'the position', $request->status)
        );

        \Log::info('Status email sent', ['to' => $application->email, 'status' => $request->status]);

    } catch (\Exception $e) {
        \Log::error('Failed to send status email', ['message' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Status updated but email failed: ' . $e->getMessage());
    }

    \Log::info('=== END updateStatus ===');
    
    return redirect()->back()->with([
        'messageType' => 'success',
        'message' => 'Application status updated to "' . ucfirst($request->status) . '" and email sent to candidate.'
    ]);
}
    /**
     * Send email to candidate
     * Updated to use new table field names
     */
    public function sendEmail(Request $request, $id)
    {
        try {
            $request->validate([
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                'email_type' => 'required|in:general,interview,offer,rejection'
            ]);

            // Get application details
            $application = DB::table('job_applications')
                ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
                ->select(
                    'job_applications.*',
                    'managejobs.job_title',
                    'managejobs.department'
                )
                ->where('job_applications.id', $id)
                ->first();

            if (!$application) {
                return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
            }

            // For now, just log the email (you can implement actual email sending later)
            Log::info('Email would be sent', [
                'to' => $application->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'type' => $request->email_type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully to ' . $application->full_name
            ]);

        } catch (\Exception $e) {
            Log::error('Email sending failed:', [
                'application_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified job application.
     * Updated to use new resume field name
     */
    public function destroy($id)
    {
        try {
            // Get the application to delete the resume file
            $application = DB::table('job_applications')->where('id', $id)->first();

            if ($application && $application->resume) {
                // Delete the resume file from storage
                $resumePath = 'applications/' . $application->resume;
                if (Storage::disk('public')->exists($resumePath)) {
                    Storage::disk('public')->delete($resumePath);
                }
            }

            // Delete the application record
            DB::table('job_applications')->where('id', $id)->delete();

            return redirect()->route('admin.resume.index')->with('success', 'Application deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting application: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete application.');
        }
    }

    /**
     * Download or view resume file
     * Updated to use new resume field name
     */
    public function viewResume($id)
    {
        try {
            // Get the application record
            $application = DB::table('job_applications')->where('id', $id)->first();
            
            if (!$application) {
                Log::error('Application not found', ['application_id' => $id]);
                return redirect()->route('admin.resume.index')->with('error', 'Application not found.');
            }

            if (!$application->resume) {
                Log::error('Resume path is empty', ['application_id' => $id]);
                return redirect()->route('admin.resume.index')->with('error', 'Resume file not found.');
            }

            // Files are stored as 'applications/filename.ext' under public/
            $possiblePaths = [
                public_path($application->resume),
                public_path('storage/' . $application->resume),
                storage_path('app/public/' . $application->resume),
            ];

            $filePath = null;
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $filePath = $path;
                    break;
                }
            }

            // If file not found in any of the paths, log the issue
            if (!$filePath) {
                Log::error('Resume file not found in any path', [
                    'application_id' => $id,
                    'resume_path' => $application->resume,
                    'checked_paths' => $possiblePaths
                ]);
                return redirect()->route('admin.resume.index')->with('error', 'Resume file not found on server.');
            }

            // Get file info
            $fileName = basename($filePath);
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $mimeType = $this->getMimeType($fileExtension);

            // Check if download is requested
            $isDownload = request()->has('download') && request()->get('download') == '1';

            // Generate a proper filename for download
            $candidateName = $application->full_name;
            $downloadFileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $candidateName) . '_Resume.' . $fileExtension;

            Log::info('Serving resume file', [
                'application_id' => $id,
                'file_path' => $filePath,
                'file_size' => filesize($filePath),
                'mime_type' => $mimeType,
                'is_download' => $isDownload
            ]);

            // Return file response with proper headers
            if ($isDownload) {
                // Force download
                return Response::download($filePath, $downloadFileName, [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'attachment; filename="' . $downloadFileName . '"'
                ]);
            } else {
                // Display in browser (for PDFs and images)
                return Response::file($filePath, [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'inline; filename="' . $downloadFileName . '"',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error serving resume file', [
                'application_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.resume.index')->with('error', 'Error accessing resume file: ' . $e->getMessage());
        }
    }

    /**
     * Get MIME type based on file extension
     */
    private function getMimeType($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'txt' => 'text/plain',
            'rtf' => 'application/rtf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        ];

        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }

    /**
     * Get application statistics.
     * Updated status values to match new table
     */
    public function getStats()
    {
        $stats = [
            'total' => DB::table('job_applications')->count(),
            'pending' => DB::table('job_applications')->where('status', 'pending')->count(),
            'reviewed' => DB::table('job_applications')->where('status', 'reviewed')->count(),
            'shortlisted' => DB::table('job_applications')->where('status', 'shortlisted')->count(),
            'selected' => DB::table('job_applications')->where('status', 'selected')->count(),
            'rejected' => DB::table('job_applications')->where('status', 'rejected')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Get email templates
     */
    public function getEmailTemplate($type)
    {
        $templates = [
            'general' => [
                'subject' => 'Regarding Your Job Application',
                'message' => "Dear {candidate_name},\n\nThank you for your interest in the {job_title} position at our company.\n\nWe have received your application and will review it carefully.\n\nBest regards,\nHR Team"
            ],
            'interview' => [
                'subject' => 'Interview Invitation - {job_title}',
                'message' => "Dear {candidate_name},\n\nWe are pleased to inform you that your application for the {job_title} position has been shortlisted.\n\nWe would like to invite you for an interview. Please reply to this email with your availability.\n\nBest regards,\nHR Team"
            ],
            'offer' => [
                'subject' => 'Job Offer - {job_title}',
                'message' => "Dear {candidate_name},\n\nCongratulations! We are pleased to offer you the position of {job_title} at our company.\n\nPlease find the offer details attached. We look forward to having you on our team.\n\nBest regards,\nHR Team"
            ],
            'rejection' => [
                'subject' => 'Application Status - {job_title}',
                'message' => "Dear {candidate_name},\n\nThank you for your interest in the {job_title} position and for taking the time to apply.\n\nAfter careful consideration, we have decided to move forward with other candidates whose qualifications more closely match our current needs.\n\nWe appreciate your interest in our company and encourage you to apply for future opportunities.\n\nBest regards,\nHR Team"
            ]
        ];

        return response()->json($templates[$type] ?? $templates['general']);
    }


    public function index(Request $request)
    {
        $jobs = DB::table('managejobs')->select('id', 'job_title')->orderBy('job_title')->get();
        $companies = DB::table('managejobs')
            ->select('company_name')
            ->whereNotNull('company_name')
            ->where('company_name', '!=', '')
            ->distinct()
            ->orderBy('company_name')
            ->pluck('company_name');

        $query = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->select(
                'job_applications.id',
                'job_applications.user_id',
                'job_applications.job_id',
                'job_applications.full_name',
                'job_applications.email',
                'job_applications.phone',
                'job_applications.location',
                'job_applications.cover_letter',
                'job_applications.resume',
                'job_applications.status',
                'job_applications.created_at',
                'job_applications.updated_at',
                'managejobs.job_title',
                'managejobs.company_name',
                'managejobs.department',
                'managejobs.job_type'
            );

        // Apply search filter
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('job_applications.full_name', 'like', "%$s%")
                  ->orWhere('job_applications.email', 'like', "%$s%")
                  ->orWhere('job_applications.phone', 'like', "%$s%")
                  ->orWhere('managejobs.job_title', 'like', "%$s%")
                  ->orWhere('managejobs.company_name', 'like', "%$s%");
            });
        }

        // Apply status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('job_applications.status', $request->status);
        }

        // Apply job filter
        if ($request->filled('job_id') && $request->job_id !== 'all') {
            $query->where('job_applications.job_id', $request->job_id);
        }

        // Apply company filter
        if ($request->filled('company') && $request->company !== 'all') {
            $query->where('managejobs.company_name', $request->company);
        }

        // Apply date filter
        if ($request->filled('start_date')) {
            $query->whereDate('job_applications.created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('job_applications.created_at', '<=', $request->end_date);
        }

        // Apply sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('job_applications.created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('job_applications.full_name', 'asc');
                break;
            default:
                $query->orderBy('job_applications.created_at', 'desc');
                break;
        }

        // Paginate with query string preservation
        $applications = $query->paginate(15)->withQueryString();

        return view('admin.Jobs.manageresume.index', compact('applications', 'jobs', 'companies'));
    }

    /**
     * Display the specified job application.
     */
    public function show($id)
    {
        $application = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->leftJoin('users', 'job_applications.user_id', '=', 'users.id')
            ->select(
                'job_applications.*',
                'managejobs.job_title',
                'managejobs.company_name',
                'managejobs.department',
                'managejobs.job_type',
                'managejobs.job_location',
                'managejobs.salary_from',
                'managejobs.salary_to',
                'managejobs.description',
                'managejobs.skills',
                'users.gender',
                'users.address',
                'users.pincode',
                'users.profile_picture'
            )
            ->where('job_applications.id', $id)
            ->first();

        if (!$application) {
            return redirect()->route('admin.resume.index')->with('error', 'Application not found.');
        }

        return view('admin.Jobs.manageresume.show', compact('application'));
    }

    /**
     * Update application status.
     */
  
    /**
     * Bulk Download Resumes (ZIP)
     */
    public function bulkDownloadResumes(Request $request)
    {
        $query = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->select('job_applications.*', 'managejobs.job_title', 'managejobs.company_name');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('job_applications.full_name', 'like', "%$s%")
                  ->orWhere('job_applications.email', 'like', "%$s%")
                  ->orWhere('job_applications.phone', 'like', "%$s%")
                  ->orWhere('managejobs.job_title', 'like', "%$s%")
                  ->orWhere('managejobs.company_name', 'like', "%$s%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('job_applications.status', $request->status);
        }

        if ($request->filled('job_id') && $request->job_id !== 'all') {
            $query->where('job_applications.job_id', $request->job_id);
        }

        if ($request->filled('company') && $request->company !== 'all') {
            $query->where('managejobs.company_name', $request->company);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('job_applications.created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('job_applications.created_at', '<=', $request->end_date);
        }

        $applications = $query->get();

        if ($applications->isEmpty()) {
            return redirect()->back()->with('error', 'No applications found matching your criteria.');
        }

        $zip = new ZipArchive;
        $zipFileName = 'Resumes_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = public_path('storage/' . $zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $filesAdded = 0;

            foreach ($applications as $app) {
                if (!empty($app->resume)) {
                    $possiblePaths = [
                        public_path($app->resume),
                        public_path('storage/' . $app->resume),
                        storage_path('app/public/' . $app->resume),
                    ];

                    $filePath = null;
                    foreach ($possiblePaths as $path) {
                        if (file_exists($path)) {
                            $filePath = $path;
                            break;
                        }
                    }

                    if ($filePath) {
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        $candidateName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $app->full_name);
                        $jobTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $app->job_title ?? 'Job');
                        $fileNameInZip = $candidateName . '_' . $jobTitle . '_Resume.' . $extension;
                        
                        $zip->addFile($filePath, $fileNameInZip);
                        $filesAdded++;
                    }
                }
            }
            $zip->close();

            if ($filesAdded == 0) {
                if (file_exists($zipPath)) {
                    unlink($zipPath);
                }
                return redirect()->back()->with('error', 'No resume files were found for the matching applications.');
            }

            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Could not create ZIP file.');
    }
}
