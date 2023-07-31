<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'subtotal', 'discount', 'discount_type', 'tax', 'shipping', 'total', 'user_id', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'user_id');
    }

    public function countItems()
    {
        return $this->hasMany('App\Models\Cart\CartEntry')->sum('quantity');
    }

    public function cartItems()
    {
        return $this->hasMany('App\Models\Cart\CartEntry');
    }

    public function countCartItems()
    {
        return $this->hasMany('App\Models\Cart\CartEntry')->count();
    }

     public function deleteCartItems()
    {
        return $this->hasMany('App\Models\Cart\CartEntry')->delete();
    }
}
