<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class JobapplicationReport extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('job_applications as ja')
            ->join('managejobs as mj', 'ja.job_id', '=', 'mj.id')
            ->select(
                'ja.*',
                'mj.job_title',
                'mj.company_name'
            );

        // Date range filter
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('ja.created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('ja.created_at', '<=', $request->end_date);
        }

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('mj.job_title', 'LIKE', "%{$search}%")
                  ->orWhere('mj.company_name', 'LIKE', "%{$search}%")
                  ->orWhere('ja.full_name', 'LIKE', "%{$search}%")
                  ->orWhere('ja.email', 'LIKE', "%{$search}%");
            });
        }

        $applications = $query->orderBy('ja.created_at', 'desc')->paginate(10);

        return view('admin.report.job-application.index', compact('applications'));
    }

    public function downloadPDF(Request $request)
    {
        $applications = $this->getApplicationsData($request);
        
        $data = [
            'applications' => $applications,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'search' => $request->search,
            'total' => $applications->count()
        ];

        $pdf = PDF::loadView('admin.report.job-application.pdf', $data);
        
        return $pdf->download('job-applications-report-' . date('Y-m-d') . '.pdf');
    }

    public function downloadCSV(Request $request)
    {
        $applications = $this->getApplicationsData($request);
        
        $fileName = 'job-applications-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($applications) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Add CSV headers
            fputcsv($file, [
                'Application ID',
                'Job Title',
                'Company',
                'Applicant Name',
                'Email',
                'Phone',
                'Status',
                'Applied Date'
            ]);

            // Add data rows
            foreach ($applications as $application) {
                fputcsv($file, [
                    '#APP' . str_pad($application->id, 4, '0', STR_PAD_LEFT),
                    $application->job_title,
                    $application->company_name,
                    $application->full_name,
                    $application->email,
                    $application->phone,
                    ucfirst($application->status),
                    \Carbon\Carbon::parse($application->created_at)->format('M d, Y')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getApplicationsData(Request $request)
    {
        $query = DB::table('job_applications as ja')
            ->join('managejobs as mj', 'ja.job_id', '=', 'mj.id')
            ->select(
                'ja.*',
                'mj.job_title',
                'mj.company_name'
            );

        // Date range filter
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('ja.created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('ja.created_at', '<=', $request->end_date);
        }

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('mj.job_title', 'LIKE', "%{$search}%")
                  ->orWhere('mj.company_name', 'LIKE', "%{$search}%")
                  ->orWhere('ja.full_name', 'LIKE', "%{$search}%")
                  ->orWhere('ja.email', 'LIKE', "%{$search}%");
            });
        }

        return $query->orderBy('ja.created_at', 'desc')->get();
    }
}
