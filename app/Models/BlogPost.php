<?php
// app/Models/BlogPost.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'additional_images',
        'category',
        'published_at'
    ];

    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}