<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class RecurringBill extends Model
{
    protected $table= 'recurring_bill';

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'customer_id');
    }

    public function createdBy()
    {
     
        return $this->belongsTo('App\User', 'created_by');
    
    }
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch', 'branch_id');
    }
}
