<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Selected Candidate Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #666;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Selected Candidate Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Candidate Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Status</th>
                <th>Applied On</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($applications as $key => $app)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $app->full_name }}</td>
                    <td>{{ $app->email }}</td>
                    <td>{{ $app->phone }}</td>
                    <td>{{ $app->job_title }}</td>
                    <td>{{ $app->department ?? 'N/A' }}</td>
                    <td>{{ ucfirst($app->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No selected candidates found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
