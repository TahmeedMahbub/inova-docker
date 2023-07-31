<?php

namespace App\Models\Offers;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';

    protected $fillable = [
        'item_id',
        'item_variation_id',
        'base_quantity',
        'start_date',
        'end_date',
        'free_item_id',
        'free_item_variation_id',
        'free_quantity',
        'cashback_amount',
        'cashback_type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item', 'item_id');
    }

    public function itemVariation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation', 'item_variation_id');
    }

    public function freeItem(){
        return $this->belongsTo('App\Models\Inventory\Item', 'free_item_id');
    }

    public function freeItemVariation(){
        return $this->belongsTo('App\Models\Inventory\ItemVariation', 'free_item_variation_id');
    }

    public function billFreeEntry(){
        return $this->hasMany('App\Models\MoneyOut\BillFreeEntry', 'offer_id');
    }
    
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Setting\Unit', 'unit_id');
    }

}
