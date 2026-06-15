<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_path',
        'thumbnail_path',
        'duration',
        'is_featured',
        'views',
        'record_date'
    ];

    protected $appends = ['video_url', 'thumbnail_url'];

    public function getVideoUrlAttribute()
    {
        return asset('storage/videos/' . $this->video_path);
    }

    public function getThumbnailUrlAttribute()
    {
        return asset('storage/thumbnails/' . $this->thumbnail_path);
    }

    public function incrementViews()
    {
        $this->views++;
        $this->save();
    }
}