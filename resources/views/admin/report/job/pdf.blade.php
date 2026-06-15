<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Job Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; vertical-align: top; }
        th { background-color: #f2f2f2; }
        h3 { text-align: center; }
    </style>
</head>
<body>
    <h3>Job Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Job Title</th>
                <th>Company</th>
                <th>Type</th>
                <th>Location</th>
                <th>Experience</th>
                <th>Skills</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $index => $job)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $job->job_title }}</td>
                    <td>{{ $job->company_name }}</td>
                    <td>{{ ucfirst($job->job_type) }}</td>
                    <td>{{ $job->job_location }}</td>
                    <td>{{ $job->experience }}</td>
                    <td>{{ $job->skills }}</td>
                    <td>{{ ucfirst($job->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
