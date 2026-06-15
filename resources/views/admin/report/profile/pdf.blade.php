<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; vertical-align: top; }
        th { background-color: #f2f2f2; }
        h3 { text-align: center; }
    </style>
</head>
<body>
    <h3>User Profile Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Education</th>
                <th>Experience</th>
                <th>Skills</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $user->first_name }} {{ $user->last_name }}</strong><br>
                        {{ $user->email }}<br>
                        {{ $user->phone ?? '-' }}
                    </td>
                    <td>
                        @forelse(($user->educations ?? collect()) as $edu)
                            {{ $edu->degree }} - {{ $edu->institution }} ({{ $edu->year ?? 'N/A' }})<br>
                        @empty
                            No Education
                        @endforelse
                    </td>
                    <td>
                        @forelse(($user->experiences ?? collect()) as $exp)
                            {{ $exp->job_title }} - {{ $exp->company }} ({{ $exp->start_year }} - {{ $exp->end_year ?? 'Present' }})<br>
                        @empty
                            No Experience
                        @endforelse
                    </td>
                    <td>{{ ($user->skills ?? collect())->pluck('skill_name')->join(', ') ?: '-' }}</td>
                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
