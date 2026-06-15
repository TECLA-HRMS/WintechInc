<?php
// app/Models/Education.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'degree', 'institution', 'subject', 
        'gpa', 'location', 'year'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}