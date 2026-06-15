<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail_path',
        'video_path',
        'date',
        'duration',
        'youtube_id' ,
        'video_type' ,
        'views'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'thumbnail_url',
        'video_url',
        'formatted_date'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            $video->slug = $video->generateSlug($video->title);
        });

        static::updating(function ($video) {
            if ($video->isDirty('title')) {
                $video->slug = $video->generateSlug($video->title, $video->id);
            }
        });
    }

    /**
     * Generate a unique slug.
     */
    public function generateSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Get the full public URL to the thumbnail.
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null;
    }

    /**
     * Get the full public URL to the video.
     */
    public function getVideoUrlAttribute()
    {
        return $this->video_path ? Storage::url($this->video_path) : null;
    }

    /**
     * Get the formatted date attribute.
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->format('M j, Y');
    }

    /**
     * Scope a query to search videos.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope a query to order by popularity.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Scope a query to order by recent.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('date', 'desc');
    }

    /**
     * Scope a query to get related videos.
     */
    public function scopeRelated($query, $currentVideoId)
    {
        return $query->where('id', '!=', $currentVideoId)
                    ->recent()
                    ->limit(4);
    }

    /**
     * Delete the model from the database.
     */
 
}