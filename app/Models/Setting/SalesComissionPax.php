<?php

namespace App\Models\setting;

use Illuminate\Database\Eloquent\Model;

class SalesComissionPax extends Model
{
    protected $table = "salescommission_pax";
   
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

}
