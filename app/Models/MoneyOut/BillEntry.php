<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class BillEntry extends Model
{
    protected $table = 'bill_entry';

    protected $fillable = ['item_id','account_id','quantity','rate_type','discount','discount_type','tax_id','amount','bill_id'];

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }

    public function billFreeEntry()
    {
        return $this->hasOne('App\Models\MoneyOut\BillFreeEntry','bill_entry_id');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation','variation_id');
    }
}
