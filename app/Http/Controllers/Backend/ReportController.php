<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $this->authorizeReports();

        $reports = $this->reportDefinitions();
        $summary = collect($reports)->map(function ($report, $key) use ($request) {
            $query = $this->reportQuery($key, $request);

            return array_merge($report, [
                'key' => $key,
                'total' => (clone $query)->count(),
                'latest' => (clone $query)->orderBy($report['date_column'], 'desc')->value($report['date_column']),
            ]);
        });

        return view('admin.report.index', compact('summary'));
    }

    public function export(Request $request, string $report, string $format)
    {
        $this->authorizeReports();

        abort_unless(in_array($format, ['csv', 'pdf']), 404);

        $reports = $this->reportDefinitions();
        abort_unless(isset($reports[$report]), 404);

        $definition = $reports[$report];
        $rows = $this->reportQuery($report, $request)
            ->orderBy($definition['date_column'], 'desc')
            ->get();

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('admin.report.pdf-generic', [
                'title' => $definition['title'],
                'columns' => $definition['columns'],
                'rows' => $rows,
                'filters' => $request->only(['start_date', 'end_date', 'search', 'status']),
            ])->setPaper('a4', 'landscape');

            return $pdf->download($report . '-report-' . now()->format('Y-m-d') . '.pdf');
        }

        return $this->downloadCsv($report, $definition, $rows);
    }

    private function authorizeReports(): void
    {
        $admin = DB::table('admins')->where('id', session('admin_id'))->first();
        $permissions = $admin && $admin->permissions ? json_decode($admin->permissions, true) : [];

        abort_unless(
            $admin && ($admin->role === 'super_admin' || in_array('report_management', $permissions ?? [])),
            403
        );
    }

    private function reportDefinitions(): array
    {
        return [
            'contacts' => [
                'title' => 'Enquiry Report',
                'description' => 'Contact enquiries received from the website.',
                'icon' => 'ti ti-message-circle',
                'color' => 'blue',
                'view_route' => 'admin.contact.report',
                'date_column' => 'created_at',
                'columns' => [
                    'created_at' => 'Date',
                    'name' => 'Name',
                    'email' => 'Email',
                    'phonenumber' => 'Phone',
                    'service' => 'Service',
                    'subject' => 'Subject',
                ],
            ],
            'companies' => [
                'title' => 'Company Registration Report',
                'description' => 'Registered companies, contacts, and approval status.',
                'icon' => 'ti ti-building',
                'color' => 'green',
                'view_route' => 'admin.company.report',
                'date_column' => 'created_at',
                'columns' => [
                    'created_at' => 'Date',
                    'company_name' => 'Company',
                    'name' => 'Contact Person',
                    'email' => 'Email',
                    'mobile' => 'Phone',
                    'status' => 'Status',
                ],
            ],
            'users' => [
                'title' => 'User Report',
                'description' => 'Registered users and profile information.',
                'icon' => 'ti ti-users',
                'color' => 'purple',
                'view_route' => 'admin.profile.report',
                'date_column' => 'created_at',
                'columns' => [
                    'created_at' => 'Date',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'email' => 'Email',
                    'phone' => 'Phone',
                    'location' => 'Location',
                ],
            ],
            'jobs' => [
                'title' => 'Job Report',
                'description' => 'Job postings by company, location, and status.',
                'icon' => 'ti ti-briefcase',
                'color' => 'amber',
                'view_route' => 'admin.job.report',
                'date_column' => 'created_at',
                'columns' => [
                    'created_at' => 'Date',
                    'job_title' => 'Job Title',
                    'company_name' => 'Company',
                    'job_location' => 'Location',
                    'job_type' => 'Type',
                    'status' => 'Status',
                ],
            ],
            'applications' => [
                'title' => 'Job Application Report',
                'description' => 'Applications submitted by candidates.',
                'icon' => 'ti ti-file-description',
                'color' => 'indigo',
                'view_route' => 'admin.job-applications.report',
                'date_column' => 'ja.created_at',
                'columns' => [
                    'created_at' => 'Date',
                    'job_title' => 'Job Title',
                    'company_name' => 'Company',
                    'full_name' => 'Applicant',
                    'email' => 'Email',
                    'status' => 'Status',
                ],
            ],
            'selected_candidates' => [
                'title' => 'Selected Candidate Report',
                'description' => 'Candidates marked as selected.',
                'icon' => 'ti ti-user-check',
                'color' => 'teal',
                'view_route' => 'admin.selected.candidate.report',
                'date_column' => 'ja.created_at',
                'columns' => [
                    'created_at' => 'Date',
                    'job_title' => 'Job Title',
                    'company_name' => 'Company',
                    'full_name' => 'Candidate',
                    'email' => 'Email',
                    'phone' => 'Phone',
                ],
            ],
        ];
    }

    private function reportQuery(string $report, Request $request)
    {
        $definitions = $this->reportDefinitions();
        $dateColumn = $definitions[$report]['date_column'];

        $query = match ($report) {
            'contacts' => DB::table('contacts'),
            'companies' => DB::table('company_registrations'),
            'users' => DB::table('users'),
            'jobs' => DB::table('managejobs'),
            'applications' => DB::table('job_applications as ja')
                ->join('managejobs as mj', 'ja.job_id', '=', 'mj.id')
                ->select('ja.created_at', 'mj.job_title', 'mj.company_name', 'ja.full_name', 'ja.email', 'ja.status'),
            'selected_candidates' => DB::table('job_applications as ja')
                ->join('managejobs as mj', 'ja.job_id', '=', 'mj.id')
                ->where('ja.status', 'selected')
                ->select('ja.created_at', 'mj.job_title', 'mj.company_name', 'ja.full_name', 'ja.email', 'ja.phone'),
        };

        if (!in_array($report, ['applications', 'selected_candidates'])) {
            $query->select(array_keys($definitions[$report]['columns']));
        }

        if ($request->filled('start_date')) {
            $query->whereDate($dateColumn, '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate($dateColumn, '<=', $request->end_date);
        }

        if ($request->filled('status') && in_array($report, ['companies', 'jobs', 'applications'])) {
            $statusColumn = $report === 'applications' ? 'ja.status' : 'status';
            $query->where($statusColumn, $request->status);
        }

        if ($request->filled('search')) {
            $this->applySearch($query, $report, $request->search);
        }

        return $query;
    }

    private function applySearch($query, string $report, string $search): void
    {
        $query->where(function ($q) use ($report, $search) {
            match ($report) {
                'contacts' => $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phonenumber', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%"),
                'companies' => $q->where('company_name', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%"),
                'users' => $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%"),
                'jobs' => $q->where('job_title', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('job_location', 'like', "%{$search}%"),
                'applications', 'selected_candidates' => $q->where('mj.job_title', 'like', "%{$search}%")
                    ->orWhere('mj.company_name', 'like', "%{$search}%")
                    ->orWhere('ja.full_name', 'like', "%{$search}%")
                    ->orWhere('ja.email', 'like', "%{$search}%"),
            };
        });
    }

    private function downloadCsv(string $report, array $definition, $rows): StreamedResponse
    {
        $fileName = $report . '-report-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($definition, $rows) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, array_values($definition['columns']));

            foreach ($rows as $row) {
                $line = [];
                foreach (array_keys($definition['columns']) as $field) {
                    $line[] = $this->formatValue($row->{$field} ?? null);
                }
                fputcsv($handle, $line);
            }

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }

    private function formatValue($value): string
    {
        if (!$value) {
            return '';
        }

        if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}/', $value)) {
            return date('d M Y h:i A', strtotime($value));
        }

        return (string) $value;
    }
}
