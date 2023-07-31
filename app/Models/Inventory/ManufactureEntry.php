<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ManufactureEntry extends Model
{
    protected $table = 'manufacture_entries';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'manufacture_id',
        'item_id',
        'variation_id',
        'required_quantity',
        'manufacture_quantity',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }
    public function item_variation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation','variation_id');
    }
}
