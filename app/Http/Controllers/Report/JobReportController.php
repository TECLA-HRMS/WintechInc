<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobReportExport;

class JobReportController extends Controller
{
    // 🧭 View job report with filters
    public function index(Request $request)
    {
        try {
            $query = DB::table('managejobs');

            // 🔍 Apply filters
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('job_title', 'like', "%$search%")
                      ->orWhere('company_name', 'like', "%$search%")
                      ->orWhere('job_location', 'like', "%$search%");
                });
            }

            $jobs = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

            return view('admin.report.job.index', compact('jobs'));
        } catch (\Exception $e) {
            Log::error('Job report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load job report.');
        }
    }

    // 🧾 Download as PDF
    public function downloadPDF(Request $request)
    {
        try {
            $query = DB::table('managejobs');

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('job_title', 'like', "%$search%")
                      ->orWhere('company_name', 'like', "%$search%")
                      ->orWhere('job_location', 'like', "%$search%");
                });
            }

            $jobs = $query->orderBy('created_at', 'desc')->get();

            $pdf = PDF::loadView('admin.report.job.pdf', compact('jobs'));
            return $pdf->download('job_report.pdf');
        } catch (\Exception $e) {
            Log::error('Job report PDF error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to download PDF.');
        }
    }

    // 📊 Download as CSV
    public function downloadCSV(Request $request)
    {
        try {
            $filters = $request->only(['start_date', 'end_date', 'search']);
            return Excel::download(new JobReportExport($filters), 'job_report.csv');
        } catch (\Exception $e) {
            Log::error('Job report CSV error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to download CSV.');
        }
    }
}
