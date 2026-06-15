<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Education</th>
            <th>Experience</th>
            <th>Skills</th>
            <th>Joined At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td>{{ ($user->educations ?? collect())->map(fn($edu) => trim(($edu->degree ?? '') . ' - ' . ($edu->institution ?? '')))->filter()->join('; ') ?: '-' }}</td>
                <td>{{ ($user->experiences ?? collect())->map(fn($exp) => trim(($exp->job_title ?? '') . ' - ' . ($exp->company ?? '')))->filter()->join('; ') ?: '-' }}</td>
                <td>{{ ($user->skills ?? collect())->pluck('skill_name')->filter()->join(', ') ?: '-' }}</td>
                <td>{{ optional($user->created_at)->format('M j, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
