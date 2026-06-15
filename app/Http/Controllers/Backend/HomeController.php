<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CompanyRegistration;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        // Basic counts
        $totalContacts = Contact::count();
        $totalUsers = User::count();
        $totalCompanyRegistrations = CompanyRegistration::count();
        $pendingCompanies = CompanyRegistration::where('status', 'new')->count();
        $totalJobs = DB::table('managejobs')->count();
        $activeJobs = DB::table('managejobs')->where('status', 'open')->count();
        
        // Job Application Statistics
        $totalApplications = DB::table('job_applications')->count();
        $pendingApplications = DB::table('job_applications')->where('status', 'pending')->count();
        $acceptedApplications = DB::table('job_applications')->where('status', 'accepted')->count();
        $rejectedApplications = DB::table('job_applications')->where('status', 'rejected')->count();

        // Contact statistics for chart
        $contactStats = DB::table('contacts')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Company registration statistics for chart
        $companyStats = DB::table('company_registrations')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Job statistics for chart
        $jobStats = DB::table('managejobs')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Job Application statistics for chart
        $applicationStats = DB::table('job_applications')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Get available years for filter dropdown (from all tables)
        $contactYears = DB::table('contacts')
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $companyYears = DB::table('company_registrations')
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $jobYears = DB::table('managejobs')
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $applicationYears = DB::table('job_applications')
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $years = $contactYears->merge($companyYears)->merge($jobYears)->merge($applicationYears)->unique()->sortDesc()->values();

        // Recent activity data
        $recentUsers = User::latest()->take(5)->get();
        $recentCompanies = CompanyRegistration::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        $recentJobs = DB::table('managejobs')->latest()->take(5)->get();
        
        // Recent Job Applications with job and user details
        $recentApplications = DB::table('job_applications')
            ->join('users', 'job_applications.user_id', '=', 'users.id')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->select(
                'job_applications.*',
                'users.first_name',
                'users.last_name',
                'users.email as user_email',
                'managejobs.job_title',
                'managejobs.company_name'
            )
            ->latest('job_applications.created_at')
            ->take(5)
            ->get();

        // High vacancy jobs
        $highVacancyJobs = $this->getHighVacancyJobs();

        return view('admin.dashboard.index', compact(
            'totalContacts',
            'totalUsers',
            'totalCompanyRegistrations',
            'pendingCompanies',
            'totalJobs',
            'activeJobs',
            'totalApplications',
            'pendingApplications',
            'acceptedApplications',
            'rejectedApplications',
            'contactStats',
            'companyStats',
            'jobStats',
            'applicationStats',
            'years',
            'recentUsers',
            'recentCompanies',
            'recentContacts',
            'recentJobs',
            'recentApplications',
            'highVacancyJobs'
        ));
    }

    private function getHighVacancyJobs()
    {
        return DB::table('managejobs')
            ->select('id', 'job_title', 'company_name', 'vacancies', 'job_location', 'status')
            ->where('vacancies', '>', 0)
            ->orderBy('vacancies', 'desc')
            ->take(10)
            ->get();
    }

    public function logout()
    {
       session()->flush();
return redirect()->route('admin.login');

    }
}