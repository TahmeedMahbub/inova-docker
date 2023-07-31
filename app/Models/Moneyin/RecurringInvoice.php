<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class RecurringInvoice extends Model
{
    protected $table = 'recurring_invoices';

     public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact','customer_id');
    }
     public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
   public function branch(){
        
        return $this->hasOne('App\Models\Branch\Branch','branch_id');
    }

}
