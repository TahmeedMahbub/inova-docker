<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class InvoiceEntry extends Model
{
    protected $table = 'invoice_entries';

    protected $fillable = ['item_id','account_id','quantity','rate_type','discount','discount_type','tax_id','amount','invoice_id'];
    
    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }

    public function invoiceFreeEntry(){
        return $this->hasOne('App\Models\Moneyin\InvoiceFreeEntry','invoice_entry_id');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation','variation_id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Setting\Unit','unit_id');
    }
}
