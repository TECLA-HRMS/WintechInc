<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Applications Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .report-details {
            margin-bottom: 15px;
        }
        .report-details p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
            text-transform: uppercase;
            font-size: 11px;
        }
        tr:nth-child(even) td {
            background-color: #fafafa;
        }
        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>

    <h2>Job Applications Report</h2>

    <div class="report-details">
        @if($start_date || $end_date)
            <p><strong>Date Range:</strong>
                {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('M d, Y') : 'N/A' }} -
                {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('M d, Y') : 'N/A' }}
            </p>
        @endif
        @if($search)
            <p><strong>Search Term:</strong> {{ $search }}</p>
        @endif
        <p><strong>Total Applications:</strong> {{ $total }}</p>
        <p><strong>Generated On:</strong> {{ now()->format('M d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Application ID</th>
                <th>Job Title</th>
                <th>Company</th>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Applied Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $index => $application)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>#APP{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $application->job_title }}</td>
                    <td>{{ $application->company_name }}</td>
                    <td>{{ $application->full_name }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->phone }}</td>
                    <td>{{ ucfirst($application->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($application->created_at)->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;">No applications found for the selected filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} Job Application Management System. All Rights Reserved.</p>
    </div>

</body>
</html>
