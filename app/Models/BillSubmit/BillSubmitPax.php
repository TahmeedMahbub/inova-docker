<?php

namespace App\Models\BillSubmit;

use Illuminate\Database\Eloquent\Model;

class BillSubmitPax extends Model
{
    protected $table = 'bill_submit_pax';


    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}




