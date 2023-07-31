<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class VendorCreditEntry extends Model
{
    protected $table = 'vendor_credit_entry';

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function itemVariation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation','variation_id');
    }

    public function vendorCredit()
    {
        return $this->belongsTo('App\Models\MoneyOut\VendorCredit','vendor_credit_id');
    }
}
