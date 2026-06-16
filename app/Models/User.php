<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'job_function_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'gender',
        'address',
        'location',
        'pincode',
        'profile_picture',
        'resume',
        'profile_updated_at',
        'profile_completion',
        'job_title',
        'bio',
        'linkedin_url',
        'portfolio_url',
        'skill',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_updated_at' => 'datetime',
    ];

 public function educations()
{
    return $this->hasMany(Education::class);
}

public function experiences()
{
    return $this->hasMany(Experience::class);
}

public function skills()
{
    return $this->hasMany(UserSkill::class);
}

public function userSkills()
{
    return $this->hasMany(UserSkill::class);
}

public function jobFunction()
{
    return $this->belongsTo(JobFunction::class, 'job_function_id');
}

 public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function calculateProfileCompletion()
    {
        $totalFields = 0;
        $completedFields = 0;

        // Personal Information (40%)
        $personalFields = ['first_name', 'last_name', 'email', 'phone', 'gender', 'address', 'location', 'pincode', 'resume'];
        foreach ($personalFields as $field) {
            $totalFields++;
            if (!empty($this->$field)) $completedFields++;
        }

        // Education (20%)
        $totalFields += 2; // At least one education entry
        if ($this->educations && $this->educations->count() > 0) $completedFields += 2;

        // Experience (20%)
        $totalFields += 2; // At least one experience entry
        if ($this->experiences && $this->experiences->count() > 0) $completedFields += 2;

        // Skills (20%)
        $totalFields += 2; // At least 3 skills
        if ($this->skills && $this->skills->count() >= 3) $completedFields += 2;

        return ($completedFields / $totalFields) * 100;
    }


    
    public function notificationPreferences()
    {
        return $this->hasOne(UserNotificationPreference::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->latest();
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }

    // Ensure user has notification preferences
    public function getNotificationPreferencesAttribute()
    {
        return $this->notificationPreferences()->firstOrCreate([
            'user_id' => $this->id
        ]);
    }
}