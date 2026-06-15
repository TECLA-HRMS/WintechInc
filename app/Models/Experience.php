<?php
// app/Models/Experience.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'job_title', 'company', 'employment_type',
        'location', 'currently_working', 'start_month', 
        'start_year', 'end_month', 'end_year'
    ];

    protected $casts = [
        'currently_working' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}