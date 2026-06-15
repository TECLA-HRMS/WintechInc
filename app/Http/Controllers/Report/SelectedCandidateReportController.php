<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use PDF;

class SelectedCandidateReportController extends Controller
{
    // Show the report page
   public function index(Request $request)
    {
        $query = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->select(
                'job_applications.*',
                'managejobs.job_title',
                'managejobs.department'
            )
            ->where('job_applications.status', 'selected');

        // Optional filters
        if ($request->filled('start_date')) {
            $query->whereDate('job_applications.created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('job_applications.created_at', '<=', $request->end_date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('job_applications.full_name', 'like', "%$search%")
                    ->orWhere('job_applications.email', 'like', "%$search%")
                    ->orWhere('managejobs.job_title', 'like', "%$search%");
            });
        }

        $applications = $query->orderBy('job_applications.created_at', 'desc')->get();

        return view('admin.report.candidate.index', compact('applications'));
    }

    // Download CSV
    public function downloadCSV(Request $request)
    {
        try {
            $query = DB::table('job_applications')
                ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
                ->select(
                    'job_applications.full_name',
                    'job_applications.email',
                    'job_applications.phone',
                    'managejobs.job_title',
                    'managejobs.company_name',
                    'managejobs.job_type',
                    'managejobs.job_location',
                    'job_applications.created_at'
                )
                ->where('job_applications.status', 'selected');

            if ($request->filled('start_date')) {
                $query->whereDate('job_applications.created_at', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('job_applications.created_at', '<=', $request->end_date);
            }
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('job_applications.full_name', 'like', "%{$search}%")
                        ->orWhere('job_applications.email', 'like', "%{$search}%")
                        ->orWhere('managejobs.job_title', 'like', "%{$search}%");
                });
            }

            $data = $query->get();

            $filename = 'selected_candidates_' . now()->format('Ymd_His') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function () use ($data) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Candidate Name', 'Email', 'Phone', 'Job Title', 'Company Name', 'Job Type', 'Job Location', 'Applied Date']);

                foreach ($data as $row) {
                    fputcsv($file, [
                        $row->full_name,
                        $row->email,
                        $row->phone,
                        $row->job_title,
                        $row->company_name,
                        $row->job_type,
                        $row->job_location,
                        Carbon::parse($row->created_at)->format('d-m-Y'),
                    ]);
                }
                fclose($file);
            };

            return Response::stream($callback, 200, $headers);
        } catch (\Exception $e) {
            Log::error('CSV download failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to download CSV.');
        }
    }

    // Download PDF
 public function downloadPDF(Request $request)
{
    try {
        $query = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->select(
                'job_applications.full_name',
                'job_applications.email',
                'job_applications.phone',
                'managejobs.job_title',
                'managejobs.department',
                'job_applications.status',
                'job_applications.created_at'
            )
            ->where('job_applications.status', 'selected');

        if ($request->filled('start_date')) {
            $query->whereDate('job_applications.created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('job_applications.created_at', '<=', $request->end_date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('job_applications.full_name', 'like', "%{$search}%")
                    ->orWhere('job_applications.email', 'like', "%{$search}%")
                    ->orWhere('managejobs.job_title', 'like', "%{$search}%");
            });
        }

        $applications = $query->orderBy('job_applications.created_at', 'desc')->get();

        $pdf = PDF::loadView('admin.report.candidate.pdf', compact('applications'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('selected_candidates_' . now()->format('Ymd_His') . '.pdf');
    } catch (\Exception $e) {
        \Log::error('PDF download failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to download PDF.');
    }
}

}
