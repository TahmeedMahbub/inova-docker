<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    protected $fillable = [
        'id',
        'transfer_from',
        'transfer_to',
        'item_category_id',
        'item_id',
        'quantity',
        'date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    protected $table='stock_transfers';

     public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function transferFrom()
    {
        return $this->belongsTo('App\Models\Branch\Branch', 'transfer_from');
    }

    public function transferTo()
    {
        return $this->belongsTo('App\Models\Branch\Branch', 'transfer_to');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Setting\Unit', 'unit_id');
    }
}
