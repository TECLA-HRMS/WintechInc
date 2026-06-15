<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyRegistration;
use Illuminate\Support\Facades\Storage;

class CompanyRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = CompanyRegistration::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('company_name', 'like', "%$search%")
                  ->orWhere('mobile', 'like', "%$search%")
                  ->orWhere('position', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        match($request->sort) {
            'oldest' => $query->oldest(),
            'name'   => $query->orderBy('name'),
            default  => $query->latest(),
        };

        $registrations = $query->paginate(10)->withQueryString();

        return view('admin.company-registrations.index', compact('registrations'));
    }

    public function show(CompanyRegistration $companyRegistration)
    {
        return view('admin.company-registrations.show', compact('companyRegistration'));
    }

    public function updateStatus(Request $request, CompanyRegistration $companyRegistration)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,under_review,accepted,rejected'
        ]);

        $companyRegistration->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function destroy(CompanyRegistration $companyRegistration)
    {
        // Delete associated files
        if ($companyRegistration->job_brief_path) {
            $fullPath = public_path($companyRegistration->job_brief_path);
            if (file_exists($fullPath)) unlink($fullPath);
        }
        
        if ($companyRegistration->company_logo_path) {
            $fullPath = public_path($companyRegistration->company_logo_path);
            if (file_exists($fullPath)) unlink($fullPath);
        }

        $companyRegistration->delete();

        return redirect()->route('admin.company.registrations.index')
            ->with('success', 'Registration deleted successfully!');
    }

    public function export(Request $request)
    {
        $registrations = CompanyRegistration::latest()->get();

        $fileName = 'company-registrations-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, [
            'ID', 'Name', 'Email', 'Mobile', 'Company Name', 'Position', 
            'Location', 'Status', 'Submitted Date'
        ]);

        foreach ($registrations as $registration) {
            fputcsv($handle, [
                $registration->id,
                $registration->name,
                $registration->email,
                $registration->mobile,
                $registration->company_name,
                $registration->position,
                $registration->location,
                ucfirst(str_replace('_', ' ', $registration->status)),
                $registration->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);

        return response()->streamDownload(function() use ($handle) {
            //
        }, $fileName, $headers);
    }

    /**
     * Download individual company registration data as PDF
     */
    public function download(CompanyRegistration $companyRegistration)
    {
        $data = [
            'registration' => $companyRegistration
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.company-registrations.pdf', $data);
        
        $fileName = 'company-registration-' . $companyRegistration->company_name . '-' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($fileName);
    }

    /**
     * Download individual company registration data as CSV
     */
    public function downloadCsv(CompanyRegistration $companyRegistration)
    {
        $fileName = 'company-registration-' . $companyRegistration->company_name . '-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return response()->streamDownload(function() use ($companyRegistration) {
            $handle = fopen('php://output', 'w');
            
            // Header row
            fputcsv($handle, ['Field', 'Value']);
            
            // Data rows
            $data = [
                'ID' => $companyRegistration->id,
                'Name' => $companyRegistration->name,
                'Email' => $companyRegistration->email,
                'Mobile' => $companyRegistration->mobile,
                'Company Name' => $companyRegistration->company_name,
                'Position' => $companyRegistration->position,
                'Location' => $companyRegistration->location,
                'Industry' => $companyRegistration->industry,
                'Employee Count' => $companyRegistration->employee_count,
                'Status' => ucfirst(str_replace('_', ' ', $companyRegistration->status)),
                'Admin Notes' => $companyRegistration->admin_notes,
                'Submitted Date' => $companyRegistration->created_at->format('Y-m-d H:i:s'),
                'Last Updated' => $companyRegistration->updated_at->format('Y-m-d H:i:s'),
            ];

            foreach ($data as $key => $value) {
                fputcsv($handle, [$key, $value]);
            }

            fclose($handle);
        }, $fileName, $headers);
    }
}