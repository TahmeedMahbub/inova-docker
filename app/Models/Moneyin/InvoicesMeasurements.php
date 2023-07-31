<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class InvoicesMeasurements extends Model
{
    protected $table = 'invoices_measurements';

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice', 'invoices_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function rawMaterial()
    {
        return $this->belongsTo('App\Models\Inventory\Item','raw_material_id');
    }



}
