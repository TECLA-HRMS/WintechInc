<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassRecordStat extends Model
{
    protected $fillable = ['label', 'value', 'sort_order'];

    public function massRecord()
    {
        return $this->belongsTo(MassRecord::class);
    }
}