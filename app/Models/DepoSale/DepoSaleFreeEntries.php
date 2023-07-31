<?php

namespace App\Models\DepoSale;

use Illuminate\Database\Eloquent\Model;

class DepoSaleFreeEntries extends Model
{
    protected $table = 'depo_sales_free_entries';

    protected $fillable = [
        'depo_sales_id',
        'depo_sales_entries_id',
        'offer_id',
        'free_item_id',
        'free_item_quantity',
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

    public function depoSaleEntry()
    {
        return $this->belongsTo('App\Models\DepoSale\DepoSaleEntries','depo_sales_entries_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Models\Offers\Offers','offer_id');
    }

    public function freeItem()
    {
        return $this->belongsTo('App\Models\Inventory\Item','free_item_id');
    }
}
