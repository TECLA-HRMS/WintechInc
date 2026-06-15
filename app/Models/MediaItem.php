<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'event_date',
        'description',
        'thumbnail_path',
        'file_path',
        'youtube_id',
        'video_source',
        'duration',
        'views'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Get the URL for the thumbnail image
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null;
    }

    /**
     * Get the URL for the media file
     */
    public function getMediaUrlAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }

    /**
     * Get the embed URL for YouTube videos
     */
    public function getYoutubeEmbedUrlAttribute()
    {
        if ($this->type === 'video' && $this->video_source === 'youtube') {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        }
        return null;
    }

    /**
     * Scope for filtering by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for popular items
     */
    public function scopePopular($query, $limit = 5)
    {
        return $query->orderBy('views', 'desc')->limit($limit);
    }

    /**
     * Scope for recent items
     */
    public function scopeRecent($query, $limit = 5)
    {
        return $query->orderBy('event_date', 'desc')->limit($limit);
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function booted()
    {
        static::deleting(function ($mediaItem) {
            if ($mediaItem->thumbnail_path) {
                Storage::delete($mediaItem->thumbnail_path);
            }
            if ($mediaItem->file_path) {
                Storage::delete($mediaItem->file_path);
            }
        });
    }
}