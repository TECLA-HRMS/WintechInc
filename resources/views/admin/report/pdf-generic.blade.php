<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body{font-family:DejaVu Sans,sans-serif;color:#111827;font-size:11px}
        .header{border-bottom:2px solid #1e40af;padding-bottom:12px;margin-bottom:14px}
        h1{font-size:20px;margin:0;color:#0f172a}
        .meta{font-size:10px;color:#64748b;margin-top:4px}
        table{width:100%;border-collapse:collapse}
        th{background:#eff6ff;color:#1e40af;text-align:left;padding:8px;border:1px solid #dbeafe;font-size:10px}
        td{padding:7px;border:1px solid #e5e7eb;vertical-align:top}
        tr:nth-child(even) td{background:#f8fafc}
        .empty{text-align:center;padding:24px;color:#64748b}
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="meta">Generated on {{ now()->format('d M Y h:i A') }}</div>
        @if(array_filter($filters))
            <div class="meta">
                Filters:
                @foreach(array_filter($filters) as $key => $value)
                    {{ ucwords(str_replace('_', ' ', $key)) }}: {{ $value }}@if(!$loop->last), @endif
                @endforeach
            </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                @foreach($columns as $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach(array_keys($columns) as $field)
                        <td>
                            @php $value = $row->{$field} ?? ''; @endphp
                            @if($value && is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}/', $value))
                                {{ date('d M Y h:i A', strtotime($value)) }}
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr><td colspan="{{ count($columns) }}" class="empty">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
