<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = array();

    public function posisi()
    {
        return $this->belongsTo('\App\Models\Position','position_id','id');
    }
}
