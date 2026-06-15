<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Company Registration - {{ $registration->company_name }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px; }
        .company-name { font-size: 24px; font-weight: bold; color: #2c3e50; }
        .section { margin-bottom: 25px; }
        .section-title { background-color: #f8f9fa; padding: 10px; font-weight: bold; border-left: 4px solid #007bff; margin-bottom: 15px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .info-item { margin-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; }
        .footer { margin-top: 50px; text-align: center; color: #666; font-size: 12px; }
        .status-badge { 
            display: inline-block; 
            padding: 5px 10px; 
            border-radius: 15px; 
            font-size: 12px; 
            font-weight: bold; 
        }
        .status-new { background-color: #ffc107; color: #000; }
        .status-contact { background-color: #17a2b8; color: #fff; }
        .status-under_review { background-color: #6c757d; color: #fff; }
        .status-accepted { background-color: #28a745; color: #fff; }
        .status-rejected { background-color: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">{{ $registration->company_name }}</div>
        <div>Company Registration Details</div>
        <div>Generated on: {{ date('F j, Y g:i A') }}</div>
    </div>

    <div class="section">
        <div class="section-title">Contact Information</div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Contact Person:</span>
                <span class="value">{{ $registration->name }}</span>
            </div>
            <div class="info-item">
                <span class="label">Position:</span>
                <span class="value">{{ $registration->position ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Email:</span>
                <span class="value">{{ $registration->email }}</span>
            </div>
            <div class="info-item">
                <span class="label">Mobile:</span>
                <span class="value">{{ $registration->mobile }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Company Information</div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Company Name:</span>
                <span class="value">{{ $registration->company_name }}</span>
            </div>
            <div class="info-item">
                <span class="label">Location:</span>
                <span class="value">{{ $registration->location ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Industry:</span>
                <span class="value">{{ $registration->industry ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Employee Count:</span>
                <span class="value">{{ $registration->employee_count ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Registration Status</div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Status:</span>
                <span class="value">
                    <span class="status-badge status-{{ $registration->status }}">
                        {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                    </span>
                </span>
            </div>
            <div class="info-item">
                <span class="label">Submitted Date:</span>
                <span class="value">{{ $registration->created_at->format('F j, Y g:i A') }}</span>
            </div>
            <div class="info-item">
                <span class="label">Last Updated:</span>
                <span class="value">{{ $registration->updated_at->format('F j, Y g:i A') }}</span>
            </div>
        </div>
    </div>

    @if($registration->admin_notes)
    <div class="section">
        <div class="section-title">Admin Notes</div>
        <div class="info-item">
            <span class="value">{{ $registration->admin_notes }}</span>
        </div>
    </div>
    @endif

    <div class="footer">
        This document was generated automatically from the system.<br>
        Company Registration ID: {{ $registration->id }}
    </div>
</body>
</html>