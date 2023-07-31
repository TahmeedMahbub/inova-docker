<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ItemVariationAttributeValues extends Model
{
    protected $table = 'item_variation_attribute_values';

    protected $fillable = [
        'item_variation_id',
        'attribute_values_id',
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

    public function attributeValues()
    {
        return $this->belongsTo('App\Models\Attributes\AttributeValues', 'attribute_values_id');
    }

    public function itemVariation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation');
    }
}
