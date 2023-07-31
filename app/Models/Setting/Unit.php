<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "units";
   
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

}