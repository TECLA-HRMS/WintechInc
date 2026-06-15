<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'company_name',
        'company_website',
        'location',
        'address',
        'position',
        'salary',
        'experience',
        'job_desc',
        'job_brief_path',
        'company_logo_path',
        'ip_address',
        'user_agent',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Status constants
    const STATUS_NEW = 'new';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_UNDER_REVIEW = 'under_review';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    public function getStatusOptions()
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_CONTACTED => 'Contacted',
            self::STATUS_UNDER_REVIEW => 'Under Review',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    public function getJobBriefUrlAttribute()
    {
        return $this->job_brief_path ? asset($this->job_brief_path) : null;
    }

    public function getCompanyLogoUrlAttribute()
    {
        return $this->company_logo_path ? asset($this->company_logo_path) : null;
    }

    public function getStatusBadgeAttribute()
    {
        $statusColors = [
            self::STATUS_NEW => 'bg-primary',
            self::STATUS_CONTACTED => 'bg-info',
            self::STATUS_UNDER_REVIEW => 'bg-warning',
            self::STATUS_ACCEPTED => 'bg-success',
            self::STATUS_REJECTED => 'bg-danger',
        ];

        $statusLabels = $this->getStatusOptions();

        return '<span class="badge ' . ($statusColors[$this->status] ?? 'bg-secondary') . '">' 
            . ($statusLabels[$this->status] ?? $this->status) . '</span>';
    }

    // Scope for filtering
    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeContacted($query)
    {
        return $query->where('status', self::STATUS_CONTACTED);
    }
}