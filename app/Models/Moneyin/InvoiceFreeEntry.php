<?php

namespace App\Models\MoneyIn;

use Illuminate\Database\Eloquent\Model;

class InvoiceFreeEntry extends Model
{
    protected $table = 'invoice_free_entries';
    protected $fillable = ['invoice_id', 'invoice_entry_id', 'offer_id', 'created_by', 'updated_by', 'created_at'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\MoneyIn\Invoice', 'invoice_id');
    }

    function invoiceEntry()
    {
        return $this->belongsTo('App\Models\MoneyIn\InvoiceEntry', 'invoice_entry_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\Offers\Offers', 'offer_id');
    }

    public function freeItem(){
        return $this->belongsTo('App\Models\Inventory\Item', 'free_item_id');
    }

    public function freeItemVariation(){
        return $this->belongsTo('App\Models\Inventory\ItemVariation', 'free_item_variation_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

}
