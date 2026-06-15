<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Company Registrations Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .small {
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Company Registrations Report</h2>
    <p class="small text-center">Generated on {{ date('d M Y, h:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Company Name</th>
                <th>Address</th>
                <th>Status</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $registration)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $registration->name }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->mobile ?? 'N/A' }}</td>
                    <td>{{ $registration->company_name ?? '-' }}</td>
                    <td>{{ $registration->address ?? '-' }}</td>
                    <td>{{ ucfirst($registration->status) }}</td>
                    <td>{{ $registration->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
