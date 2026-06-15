<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualRecordStat extends Model
{
    protected $fillable = ['label', 'value', 'sort_order'];

    public function massRecord()
    {
        return $this->belongsTo(IndividualRecord::class);
    }
}