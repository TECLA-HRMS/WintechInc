<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = DB::table('managejobs');

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('job_title', 'like', "%$search%")
                  ->orWhere('company_name', 'like', "%$search%")
                  ->orWhere('job_location', 'like', "%$search%");
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Job Title',
            'Company Name',
            'Job Type',
            'Work Mode',
            'Job Function',
            'Job Location',
            'Vacancies',
            'Experience',
            'Skills',
            'Salary From',
            'Salary To',
            'Start Date',
            'End Date',
            'Status',
            'Created At'
        ];
    }

    public function map($job): array
    {
        return [
            $job->id,
            $job->job_title,
            $job->company_name,
            $job->job_type,
            $job->work_mode,
            $job->job_function,
            $job->job_location,
            $job->vacancies,
            $job->experience,
            $job->skills,
            $job->salary_from,
            $job->salary_to,
            $job->start_date,
            $job->end_date,
            $job->status,
            $job->created_at,
        ];
    }
}
