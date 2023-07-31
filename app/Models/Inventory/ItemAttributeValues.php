<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ItemAttributeValues extends Model
{
    protected $table = 'item_attribute_values';

    protected $fillable = [
        'item_id',
        'attribute_values_id',
        'measurable',
        'created_by',
        'updated_by'
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
        return $this->belongsTo('App\Models\Attributes\AttributeValues', 'attribute_values_id')->with('attribute');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }
}
