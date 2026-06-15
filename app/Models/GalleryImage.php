<?php

// app/Models/GalleryImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'thumbnail_path',
        'event_date',
        'category',
        'is_featured',
        'order'
    ];

    protected $dates = ['event_date'];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : $this->image_url;
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('event_date', 'desc');
    }
}