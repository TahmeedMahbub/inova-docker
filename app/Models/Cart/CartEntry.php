<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class CartEntry extends Model
{
    protected $fillable = [
        'item_id', 'cart_id', 'quantity', 'rate', 'discount', 'discount_type', 'total', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }
}
