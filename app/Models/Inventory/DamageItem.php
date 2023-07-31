<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class DamageItem extends Model
{
    protected $table = 'damage_items';

    protected $fillable = [
        'id',
        'date',
        'item_id',
        'variation_id',
        'quantity',
        'vendor_id',
        'unit_id',
        'basic_unit_conversion',
        'note',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',

    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by','updated_by');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation','variation_id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Setting\Unit','unit_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'vendor_id');
    }

}
