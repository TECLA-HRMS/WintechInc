<?php

namespace App\Http\Controllers\Backend\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\UserNotificationPreference;
use App\Models\Notification;
use App\Http\Controllers\Backend\NewsletterController;

class ManagejobsController extends Controller
{
    /**
     * Base upload path outside the project folder.
     * Resolves to: public_html/uploads/jobs/
     */
    private function getBaseUploadPath(): string
    {
        return dirname(base_path()) . '/uploads/jobs';
    }

    /**
     * Ensure the logos directory exists outside the project.
     */
    private function ensureUploadDirExists(): void
    {
        $path = $this->getBaseUploadPath() . '/logos';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    /**
     * Store a company logo outside the project folder.
     * Returns relative path like: uploads/jobs/logos/filename.jpg
     */
    private function storeCompanyLogo($file): string
    {
        $this->ensureUploadDirExists();
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($this->getBaseUploadPath() . '/logos', $fileName);
        return 'uploads/jobs/logos/' . $fileName;
    }

    /**
     * Delete a company logo from outside the project folder.
     */
    private function deleteCompanyLogo(?string $logoPath): void
    {
        if (!$logoPath) {
            return;
        }
        $fullPath = dirname(base_path()) . '/' . $logoPath;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manageJobs = DB::table('managejobs')->paginate(10);
        return view('admin.Jobs.managejobs.index', compact('manageJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Jobs.managejobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title'       => 'required|string|max:255',
            'job_type'        => 'required|string',
            'work_mode'       => 'required|string',
            'job_function'    => 'required|string',
            'company_name'    => 'required|string|max:255',
            'company_logo'    => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'job_location'    => 'required|string|max:255',
            'vacancies'       => 'required|integer|min:1',
            'experience'      => 'required|string',
            'skills'          => 'required|string',
            'salary_from'     => 'required|numeric|min:0',
            'salary_to'       => 'required|numeric|min:0',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after:start_date',
            'status'          => 'required|string',
            'description'     => 'required|string',
            'responsibilities'=> 'required|string',
            'requirements'    => 'required|string',
        ]);

        try {
            // Handle logo upload outside project folder
            $logoPath = null;
            if ($request->hasFile('company_logo')) {
                $logoPath = $this->storeCompanyLogo($request->file('company_logo'));
            }

            // Insert job record
            DB::table('managejobs')->insert([
                'job_title'        => $validated['job_title'],
                'job_type'         => $validated['job_type'],
                'work_mode'        => $validated['work_mode'],
                'job_function'     => $validated['job_function'],
                'company_name'     => $validated['company_name'],
                'company_logo'     => $logoPath,
                'job_location'     => $validated['job_location'],
                'vacancies'        => $validated['vacancies'],
                'experience'       => $validated['experience'],
                'skills'           => $validated['skills'],
                'salary_from'      => $validated['salary_from'],
                'salary_to'        => $validated['salary_to'],
                'start_date'       => $validated['start_date'],
                'end_date'         => $validated['end_date'],
                'status'           => $validated['status'],
                'description'      => $validated['description'],
                'responsibilities' => $validated['responsibilities'],
                'requirements'     => $validated['requirements'],
                'created_at'       => now(),
                'updated_at'       => now(),
                'deleted_at'       => null,
            ]);

            $jobId = DB::getPdo()->lastInsertId();

            // Send notifications and newsletter
            $this->sendJobAlertNotifications($jobId, $validated);
            NewsletterController::sendJobAlert($validated);

            return redirect()->route('admin.managejobs.index')
                ->with('success', 'Job created successfully.');

        } catch (\Exception $e) {
            \Log::error('Job creation error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = DB::table('managejobs')->where('id', $id)->first();

        if (!$job) {
            return redirect()->route('admin.managejobs.index')
                ->with('error', 'Job not found.');
        }

        return view('admin.Jobs.managejobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $job = DB::table('managejobs')->where('id', $id)->first();

        if (!$job) {
            return redirect()->route('admin.managejobs.index')
                ->with('error', 'Job not found.');
        }

        return view('admin.Jobs.managejobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $job = DB::table('managejobs')->where('id', $id)->first();
        if (!$job) {
            return redirect()->route('admin.managejobs.index')
                ->with('error', 'Job not found.');
        }

        $validated = $request->validate([
            'job_title'        => 'required|string|max:255',
            'job_type'         => 'required|string',
            'work_mode'        => 'required|string',
            'job_function'     => 'required|string',
            'company_name'     => 'required|string|max:255',
            'company_logo'     => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'job_location'     => 'required|string|max:255',
            'vacancies'        => 'required|integer|min:1',
            'experience'       => 'required|string',
            'skills'           => 'required|string',
            'salary_from'      => 'required|numeric|min:0',
            'salary_to'        => 'required|numeric|min:0',
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after:start_date',
            'status'           => 'required|string',
            'description'      => 'required|string',
            'responsibilities' => 'required|string',
            'requirements'     => 'required|string',
        ]);

        try {
            $logoPath = $job->company_logo;

            if ($request->hasFile('company_logo')) {
                // Delete old logo from outside project folder
                $this->deleteCompanyLogo($logoPath);
                // Store new logo outside project folder
                $logoPath = $this->storeCompanyLogo($request->file('company_logo'));
            }

            DB::table('managejobs')->where('id', $id)->update([
                'job_title'        => $validated['job_title'],
                'job_type'         => $validated['job_type'],
                'work_mode'        => $validated['work_mode'],
                'job_function'     => $validated['job_function'],
                'company_name'     => $validated['company_name'],
                'company_logo'     => $logoPath,
                'job_location'     => $validated['job_location'],
                'vacancies'        => $validated['vacancies'],
                'experience'       => $validated['experience'],
                'skills'           => $validated['skills'],
                'salary_from'      => $validated['salary_from'],
                'salary_to'        => $validated['salary_to'],
                'start_date'       => $validated['start_date'],
                'end_date'         => $validated['end_date'],
                'status'           => $validated['status'],
                'description'      => $validated['description'],
                'responsibilities' => $validated['responsibilities'],
                'requirements'     => $validated['requirements'],
                'updated_at'       => now(),
            ]);

            // Send update notifications if job was reopened
            if ($job->status !== $validated['status'] && $validated['status'] === 'Open') {
                $this->sendJobUpdateNotifications($id, $validated, 'updated');
            }

            return redirect()->route('admin.managejobs.index')
                ->with('success', 'Job updated successfully.');

        } catch (\Exception $e) {
            \Log::error('Job update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $job = DB::table('managejobs')->where('id', $id)->first();

            if (!$job) {
                return redirect()->route('admin.managejobs.index')
                    ->with('error', 'Job not found.');
            }

            // Delete logo from outside project folder
            $this->deleteCompanyLogo($job->company_logo);

            DB::table('managejobs')->where('id', $id)->delete();

            return redirect()->route('admin.managejobs.index')
                ->with('success', 'Job deleted successfully.');

        } catch (\Exception $e) {
            \Log::error('Job delete error: ' . $e->getMessage());
            return redirect()->route('admin.managejobs.index')
                ->with('error', 'Failed to delete job: ' . $e->getMessage());
        }
    }

    /**
     * Bulk actions for jobs (delete, activate, deactivate).
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action'     => 'required|string',
            'job_ids'    => 'required|array',
            'job_ids.*'  => 'exists:managejobs,id',
        ]);

        $action = $request->input('action');
        $jobIds = $request->input('job_ids');

        try {
            switch ($action) {
                case 'delete':
                    foreach ($jobIds as $jobId) {
                        $job = DB::table('managejobs')->where('id', $jobId)->first();
                        if ($job) {
                            $this->deleteCompanyLogo($job->company_logo);
                        }
                    }
                    DB::table('managejobs')->whereIn('id', $jobIds)->delete();
                    $message = 'Selected jobs deleted successfully.';
                    break;

                case 'activate':
                    DB::table('managejobs')
                        ->whereIn('id', $jobIds)
                        ->update(['status' => 'Open', 'updated_at' => now()]);
                    $message = 'Selected jobs activated successfully.';
                    break;

                case 'deactivate':
                    DB::table('managejobs')
                        ->whereIn('id', $jobIds)
                        ->update(['status' => 'Closed', 'updated_at' => now()]);
                    $message = 'Selected jobs deactivated successfully.';
                    break;

                default:
                    return redirect()->back()->with('error', 'Invalid action.');
            }

            return redirect()->route('admin.managejobs.index')->with('success', $message);

        } catch (\Exception $e) {
            \Log::error('Bulk action error: ' . $e->getMessage());
            return redirect()->route('admin.managejobs.index')
                ->with('error', 'Failed to perform bulk action: ' . $e->getMessage());
        }
    }

    /**
     * Serve the company logo from outside the project folder.
     * Route: GET /admin/jobs/logo/{filename}
     */
    public function serveLogo($filename)
    {
        // Sanitize filename to prevent directory traversal
        $filename = basename($filename);
        $path = $this->getBaseUploadPath() . '/logos/' . $filename;

        if (!file_exists($path)) {
            abort(404);
        }

        $mimeType = mime_content_type($path);
        return response()->file($path, ['Content-Type' => $mimeType]);
    }

    /**
     * Get job statistics for dashboard.
     */
    public function getJobStats()
    {
        try {
            $stats = [
                'total_jobs'  => DB::table('managejobs')->count(),
                'active_jobs' => DB::table('managejobs')->where('status', 'Open')->count(),
                'closed_jobs' => DB::table('managejobs')->where('status', 'Closed')->count(),
                'recent_jobs' => DB::table('managejobs')->where('created_at', '>=', now()->subDays(7))->count(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch job statistics'], 500);
        }
    }

    /**
     * Export jobs to CSV.
     */
    public function exportJobs()
    {
        $jobs     = DB::table('managejobs')->get();
        $fileName = 'jobs_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () use ($jobs) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID', 'Job Title', 'Company', 'Job Type', 'Work Mode',
                'Location', 'Vacancies', 'Experience', 'Salary Range',
                'Start Date', 'End Date', 'Status', 'Created At',
            ]);

            foreach ($jobs as $job) {
                fputcsv($file, [
                    $job->id,
                    $job->job_title,
                    $job->company_name,
                    $job->job_type,
                    $job->work_mode,
                    $job->job_location,
                    $job->vacancies,
                    $job->experience,
                    '₹' . $job->salary_from . ' - ₹' . $job->salary_to,
                    $job->start_date,
                    $job->end_date,
                    $job->status,
                    $job->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * View all applicants for a specific job.
     */
    public function viewApplicants($jobId)
    {
        $job = DB::table('managejobs')->where('id', $jobId)->first();

        if (!$job) {
            return redirect()->route('admin.managejobs.index')
                ->with('error', 'Job not found.');
        }

        $applicants = DB::table('job_applications')
            ->join('users', 'job_applications.user_id', '=', 'users.id')
            ->where('job_applications.job_id', $jobId)
            ->select('job_applications.*', 'users.email as user_email')
            ->orderBy('job_applications.created_at', 'desc')
            ->paginate(20);

        return view('admin.Jobs.managejobs.applicants', compact('job', 'applicants'));
    }

    /**
     * Update application status.
     */
    public function updateApplicationStatus(Request $request, $applicationId)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected,selected',
        ]);

        DB::table('job_applications')
            ->where('id', $applicationId)
            ->update([
                'status'     => $validated['status'],
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Send job alert notifications to users with enabled job alerts.
     */
    private function sendJobAlertNotifications($jobId, $jobData)
    {
        try {
            $usersWithAlerts = UserNotificationPreference::where('job_alerts_enabled', true)
                ->with('user')
                ->get();

            $notificationsCreated = 0;

            foreach ($usersWithAlerts as $preference) {
                if ($this->jobMatchesPreferences($jobData, $preference)) {
                    Notification::create([
                        'user_id' => $preference->user_id,
                        'type'    => 'job_alert',
                        'title'   => 'New Job Alert: ' . $jobData['job_title'],
                        'message' => 'A new job matching your preferences has been posted: '
                            . $jobData['job_title'] . ' at ' . $jobData['company_name']
                            . ' in ' . $jobData['job_location'],
                        'data' => [
                            'job_id'       => $jobId,
                            'job_title'    => $jobData['job_title'],
                            'company_name' => $jobData['company_name'],
                            'job_location' => $jobData['job_location'],
                            'job_type'     => $jobData['job_type'],
                            'work_mode'    => $jobData['work_mode'],
                            'salary_from'  => $jobData['salary_from'],
                            'salary_to'    => $jobData['salary_to'],
                        ],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $notificationsCreated++;
                }
            }

            \Log::info('Job alert notifications sent', [
                'job_id'                  => $jobId,
                'job_title'               => $jobData['job_title'],
                'notifications_created'   => $notificationsCreated,
                'total_users_with_alerts' => $usersWithAlerts->count(),
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to send job alert notifications', [
                'job_id' => $jobId,
                'error'  => $e->getMessage(),
            ]);
        }
    }

    /**
     * Send job update notifications.
     */
    private function sendJobUpdateNotifications($jobId, $jobData, $updateType = 'updated')
    {
        try {
            $usersWithAlerts = UserNotificationPreference::where('job_alerts_enabled', true)
                ->with('user')
                ->get();

            $notificationsCreated = 0;

            foreach ($usersWithAlerts as $preference) {
                if ($this->jobMatchesPreferences($jobData, $preference)) {
                    $title = $updateType === 'updated'
                        ? 'Job Updated: ' . $jobData['job_title']
                        : 'Job Reopened: ' . $jobData['job_title'];

                    $message = $updateType === 'updated'
                        ? 'A job matching your preferences has been updated: '
                            . $jobData['job_title'] . ' at ' . $jobData['company_name']
                        : 'A job matching your preferences has been reopened: '
                            . $jobData['job_title'] . ' at ' . $jobData['company_name'];

                    Notification::create([
                        'user_id' => $preference->user_id,
                        'type'    => 'job_update',
                        'title'   => $title,
                        'message' => $message,
                        'data'    => [
                            'job_id'       => $jobId,
                            'job_title'    => $jobData['job_title'],
                            'company_name' => $jobData['company_name'],
                            'job_location' => $jobData['job_location'],
                            'job_type'     => $jobData['job_type'],
                            'update_type'  => $updateType,
                        ],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $notificationsCreated++;
                }
            }

            \Log::info('Job update notifications sent', [
                'job_id'                => $jobId,
                'update_type'           => $updateType,
                'notifications_created' => $notificationsCreated,
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to send job update notifications', [
                'job_id' => $jobId,
                'error'  => $e->getMessage(),
            ]);
        }
    }

    /**
     * Check if a job matches user notification preferences.
     */
    private function jobMatchesPreferences($jobData, $preference): bool
    {
        // Check job function preferences
        if (!empty($preference->preferred_job_functions)) {
            if (!in_array($jobData['job_function'], $preference->preferred_job_functions)) {
                return false;
            }
        }

        // Check job type preferences
        if (!empty($preference->preferred_job_types)) {
            if (!in_array($jobData['job_type'], $preference->preferred_job_types)) {
                return false;
            }
        }

        // Check location preferences (partial match)
        if (!empty($preference->preferred_locations)) {
            $locationMatch = false;
            foreach ($preference->preferred_locations as $location) {
                if (stripos($jobData['job_location'], $location) !== false) {
                    $locationMatch = true;
                    break;
                }
            }
            if (!$locationMatch) {
                return false;
            }
        }

        // Check work mode preferences
        if (!empty($preference->preferred_work_modes)) {
            if (!in_array($jobData['work_mode'], $preference->preferred_work_modes)) {
                return false;
            }
        }

        return true;
    }
}