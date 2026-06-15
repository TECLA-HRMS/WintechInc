<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyRegistration;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\CompanyRegistrationsExport;

class CompanyRegistrationReportController extends Controller
{
    public function index(Request $request)
    {
        $query = CompanyRegistration::query();

        // Date filters
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Status filter - use the correct field name and values
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search filter
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('company_name', 'like', "%$search%")
                  ->orWhere('mobile', 'like', "%$search%");
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.report.company.index', compact('registrations'));
    }

    public function downloadExcel(Request $request)
    {
        $filters = $request->only(['start_date', 'end_date', 'status', 'search']);
        $fileName = 'company-registrations-report-' . date('Y-m-d') . '.xlsx';
        return Excel::download(new CompanyRegistrationsExport($filters), $fileName);
    }

    public function downloadPDF(Request $request)
    {
        $query = CompanyRegistration::query();

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('company_name', 'like', "%$search%")
                  ->orWhere('mobile', 'like', "%$search%");
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('admin.report.company.pdf', compact('registrations'))
            ->setPaper('a4', 'landscape');

        $fileName = 'company-registrations-report-' . date('Y-m-d') . '.pdf';

        return $pdf->download($fileName);
    }
}