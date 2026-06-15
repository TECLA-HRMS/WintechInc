<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'image_path',
        'record_date',
        'record_holder',
        'holder_dob',
        'holder_location',
        'additional_images',
        'status',
        'category',
        'is_featured',
        'is_active'
    ];

    protected $dates = ['record_date', 'holder_dob'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('record_date', 'desc');
    }
    public function stats()
{
    return $this->hasMany(IndividualRecordStat::class);
} 
}