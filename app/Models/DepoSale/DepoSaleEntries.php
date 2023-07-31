<?php

namespace App\Models\DepoSale;

use Illuminate\Database\Eloquent\Model;

class DepoSaleEntries extends Model
{
    protected $table = 'depo_sales_entries';

    protected $fillable = [
        'depo_sales_id',
        'item_id',
        'variation_id',
        'quantity',
        'description',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function depoSale()
    {
        return $this->belongsTo('App\Models\DepoSale\DepoSale','depo_sales_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
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
