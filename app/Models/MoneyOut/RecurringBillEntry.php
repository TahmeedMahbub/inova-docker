<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class RecurringBillEntry extends Model
{
    protected $table = 'recurring_bill_entry';

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }
}
