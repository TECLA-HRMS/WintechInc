<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'sub_title', 'date', 'time', 'description',
        'address', 'contact_numbers', 'image', 'alangaram_by'
    ];
}
