<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of jobs with filters
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function index(Request $request)
{
    $query = $this->publicJobsQuery();

    // Search by job title, company name, or keywords
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('job_title', 'like', "%{$search}%")
              ->orWhere('company_name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('skills', 'like', "%{$search}%");
        });
    }

    // Filter by job type
    if ($request->filled('job_type')) {
        $jobTypes = is_array($request->input('job_type')) 
            ? $request->input('job_type') 
            : [$request->input('job_type')];
        $query->whereIn('job_type', $jobTypes);
    }

    // Filter by work mode
    if ($request->filled('work_mode')) {
        $workModes = is_array($request->input('work_mode')) 
            ? $request->input('work_mode') 
            : [$request->input('work_mode')];
        $query->whereIn('work_mode', $workModes);
    }

    // Filter by job function
    if ($request->filled('job_function')) {
        $jobFunctions = is_array($request->input('job_function')) 
            ? $request->input('job_function') 
            : [$request->input('job_function')];
        $query->whereIn('job_function', $jobFunctions);
    }

    // Filter by location
    if ($request->filled('location')) {
        $locations = is_array($request->input('location')) 
            ? $request->input('location') 
            : [$request->input('location')];
        $query->whereIn('job_location', $locations);
    }

    // Filter by salary range
    if ($request->filled('salary_min')) {
        $query->where('salary_from', '>=', $request->input('salary_min'));
    }

    if ($request->filled('salary_max')) {
        $query->where('salary_to', '<=', $request->input('salary_max'));
    }

    // Filter by experience level
    if ($request->filled('experience')) {
        $experiences = is_array($request->input('experience')) 
            ? $request->input('experience') 
            : [$request->input('experience')];
        $query->whereIn('experience', $experiences);
    }

    // Filter by job posted date
    if ($request->filled('posted_date')) {
        $postedDate = $request->input('posted_date');
        $now = now();
        
        if ($postedDate === 'last_24_hours') {
            $query->where('created_at', '>=', $now->subHours(24));
        } elseif ($postedDate === 'last_7_days') {
            $query->where('created_at', '>=', $now->subDays(7));
        } elseif ($postedDate === 'last_30_days') {
            $query->where('created_at', '>=', $now->subDays(30));
        }
    }

    // Sort by
    $sortBy = $request->input('sort_by', 'featured');
    if ($sortBy === 'newest') {
        $query->orderBy('created_at', 'desc');
    } elseif ($sortBy === 'oldest') {
        $query->orderBy('created_at', 'asc');
    } else {
        // Featured (default)
        $query->orderBy('created_at', 'desc');
    }

    // Paginate results
    $jobs = $query->paginate(10);

    // Get filter options for sidebar - with fallback defaults
    $jobTypes = $this->publicJobsQuery()
        ->whereNotNull('job_type')
        ->where('job_type', '!=', '')
        ->distinct()
        ->pluck('job_type')
        ->filter()
        ->values();
    
    // Add default job types if none found
    if ($jobTypes->isEmpty()) {
        $jobTypes = collect(['Full-Time', 'Part-Time', 'Internship', 'Contract', 'Freelance']);
    }

    $workModes = $this->publicJobsQuery()
        ->whereNotNull('work_mode')
        ->where('work_mode', '!=', '')
        ->distinct()
        ->pluck('work_mode')
        ->filter()
        ->values();
    
    // Add default work modes if none found
    if ($workModes->isEmpty()) {
        $workModes = collect(['On-site', 'Remote', 'Hybrid']);
    }

    $jobFunctions = $this->publicJobsQuery()
        ->whereNotNull('job_function')
        ->where('job_function', '!=', '')
        ->distinct()
        ->pluck('job_function')
        ->filter()
        ->values();
    
    // Add default job functions if none found
    if ($jobFunctions->isEmpty()) {
        $jobFunctions = collect([
            'IT & Software',
            'Marketing',
            'Sales',
            'Human Resources',
            'Finance',
            'Operations',
            'Customer Service',
            'Design',
            'Engineering',
            'Management'
        ]);
    }

    $locations = $this->publicJobsQuery()
        ->whereNotNull('job_location')
        ->where('job_location', '!=', '')
        ->distinct()
        ->pluck('job_location')
        ->filter()
        ->values();
    
    // Add default locations if none found
    if ($locations->isEmpty()) {
        $locations = collect([
            'Mumbai',
            'Delhi',
            'Bangalore',
            'Hyderabad',
            'Chennai',
            'Pune',
            'Kolkata',
            'Ahmedabad',
            'Jaipur',
            'Noida'
        ]);
    }

    $experiences = $this->publicJobsQuery()
        ->whereNotNull('experience')
        ->where('experience', '!=', '')
        ->distinct()
        ->pluck('experience')
        ->filter()
        ->values();
    
    // Add default experience levels if none found
    if ($experiences->isEmpty()) {
        $experiences = collect([
            'Fresher',
            '0-1 years',
            '1-3 years',
            '3-5 years',
            '5-10 years',
            '10+ years'
        ]);
    }

    // Pass current filter values to the view
    $currentFilters = [
        'search' => $request->input('search'),
        'job_type' => $request->input('job_type', []),
        'work_mode' => $request->input('work_mode', []),
        'job_function' => $request->input('job_function', []),
        'location' => $request->input('location', []),
        'salary_min' => $request->input('salary_min'),
        'salary_max' => $request->input('salary_max'),
        'experience' => $request->input('experience', []),
        'posted_date' => $request->input('posted_date'),
        'sort_by' => $request->input('sort_by', 'featured'),
    ];

    return view('site.job.index', compact(
        'jobs',
        'jobTypes',
        'workModes',
        'jobFunctions',
        'locations',
        'experiences',
        'currentFilters'
    ));
}

    /**
     * Display a single job detail
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suggestions(Request $request)
    {
        $q = trim($request->input('q', ''));
        if (strlen($q) < 1) return response()->json([]);

        $jobs = $this->publicJobsQuery()
            ->where(function($query) use ($q) {
                $query->where('job_title', 'like', "%{$q}%")
                      ->orWhere('company_name', 'like', "%{$q}%")
                      ->orWhere('job_location', 'like', "%{$q}%");
            })
            ->select('id', 'job_title', 'company_name', 'job_location', 'job_type')
            ->limit(8)
            ->get();

        return response()->json($jobs);
    }

    public function show($id)
    {
        $job = $this->publicJobsQuery()->where('id', $id)->first();

        if (!$job) {
            abort(404, 'Job not found');
        }

        $similarJobs = DB::table('managejobs')
            ->where('id', '!=', $id)
            ->whereRaw('LOWER(status) = ?', ['open'])
            ->where(function($q) use ($job) {
                $q->where('job_function', $job->job_function)
                  ->orWhere('job_location', $job->job_location)
                  ->orWhere('job_type', $job->job_type);
            })
            ->limit(6)
            ->get();

        $user = Auth::check() ? Auth::user() : null;

        return view('site.job-detail.index', compact('job', 'similarJobs', 'user'));
    }

    /**
     * Get job details as JSON for modal popup via AJAX
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobDetails($id)
{
    $job = $this->publicJobsQuery()->where('id', $id)->first();

    if (!$job) {
        return response()->json(['error' => 'Job not found'], 404);
    }

    // Format the response for the modal
    return response()->json([
        'id' => $job->id,
        'job_title' => $job->job_title,
        'job_type' => $job->job_type,
        'work_mode' => $job->work_mode,
        'job_function' => $job->job_function,
        'company_name' => $job->company_name,
        'company_logo' => $job->company_logo,
        'job_location' => $job->job_location,
        'salary_from' => number_format($job->salary_from),
        'salary_to' => number_format($job->salary_to),
        'vacancies' => $job->vacancies,
        'experience' => $job->experience,
        'skills' => $job->skills,
        'description' => $job->description,
        'responsibilities' => $job->responsibilities,
        'requirements' => $job->requirements,
        'start_date' => $job->start_date,
        'end_date' => $job->end_date,
        'posted_time' => \Carbon\Carbon::parse($job->created_at)->diffForHumans(),
        'created_at' => $job->created_at
    ]);
}

private function publicJobsQuery()
{
    return DB::table('managejobs')->whereRaw('LOWER(status) = ?', ['open']);
}

}
