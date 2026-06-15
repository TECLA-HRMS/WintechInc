<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactReportExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ContactReportController extends Controller
{
    // Show report with filter
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->get();

        return view('admin.report.contact.index', compact('contacts'));
    }

    // Excel download
    public function download(Request $request)
    {
        return Excel::download(new ContactReportExport($request->all()), 'contact_report.xlsx');
    }

    // PDF download
    public function downloadPDF(Request $request)
    {
        $query = Contact::query();

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('admin.report.contact.pdf', compact('contacts'))->setPaper('a4', 'landscape');

        return $pdf->download('contact_report.pdf');
    }
}
