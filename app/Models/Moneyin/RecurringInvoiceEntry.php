<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class RecurringInvoiceEntry extends Model
{
    protected $table = 'recurring_invoice_entries';

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }
}
