<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobApplicationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = DB::table('job_applications')
            ->join('managejobs', 'job_applications.job_id', '=', 'managejobs.id')
            ->select(
                'job_applications.*',
                'managejobs.job_title',
                'managejobs.company_name'
            );

        if (!empty($this->filters['search'])) {
            $s = $this->filters['search'];
            $query->where(function($q) use ($s) {
                $q->where('job_applications.full_name', 'like', "%$s%")
                  ->orWhere('job_applications.email', 'like', "%$s%")
                  ->orWhere('job_applications.phone', 'like', "%$s%")
                  ->orWhere('managejobs.job_title', 'like', "%$s%")
                  ->orWhere('managejobs.company_name', 'like', "%$s%");
            });
        }

        if (!empty($this->filters['status']) && $this->filters['status'] !== 'all') {
            $query->where('job_applications.status', $this->filters['status']);
        }

        if (!empty($this->filters['job_id']) && $this->filters['job_id'] !== 'all') {
            $query->where('job_applications.job_id', $this->filters['job_id']);
        }

        $sort = $this->filters['sort'] ?? 'latest';
        switch ($sort) {
            case 'oldest':
                $query->orderBy('job_applications.created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('job_applications.full_name', 'asc');
                break;
            default:
                $query->orderBy('job_applications.created_at', 'desc');
                break;
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Application ID',
            'Applicant Name',
            'Email',
            'Phone',
            'Location',
            'Job Title',
            'Company Name',
            'Status',
            'Cover Letter',
            'Applied Date'
        ];
    }

    public function map($application): array
    {
        return [
            $application->id,
            $application->full_name,
            $application->email,
            $application->phone,
            $application->location,
            $application->job_title,
            $application->company_name,
            ucfirst($application->status),
            $application->cover_letter,
            \Carbon\Carbon::parse($application->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
