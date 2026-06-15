<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'highlight',
        'full_description',
        'record_date',
        'image_path',
        'category',
        'views',
        'additional_images',
        'participants_count',
        'location',
        'is_featured'
    ];

    protected $dates = ['record_date'];

    public function getFormattedDateAttribute()
    {
        return $this->record_date->format('d/m/Y');
    }
    // app/Models/MassRecord.php
public function stats()
{
    return $this->hasMany(MassRecordStat::class)->orderBy('sort_order');
}
}