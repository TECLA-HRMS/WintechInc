<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Contact::query();

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone Number', 'Subject', 'Message', 'Submitted At'];
    }

    public function map($contact): array
    {
        return [
            $contact->name,
            $contact->email,
            $contact->phonenumber,
            $contact->subject,
            $contact->description,
            $contact->created_at->format('d M Y, h:i A'),
        ];
    }
}
