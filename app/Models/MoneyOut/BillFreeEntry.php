<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class BillFreeEntry extends Model
{
    protected $table = 'bill_free_entries';
    protected $fillable = ['bill_id', 'bill_entry_id', 'offer_id', 'created_by', 'updated_by', 'created_at'];

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill', 'bill_id');
    }

    function billEntry()
    {
        return $this->belongsTo('App\Models\MoneyOut\BillEntry', 'bill_entry_id');
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
