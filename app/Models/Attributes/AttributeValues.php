<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
    protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id',
        'value',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attributes\Attributes', 'attribute_id');
    }

    public function ItemAttributeValues()
    {
        return $this->hasMany('App\Models\Inventory\ItemAttributeValues', 'attribute_values_id');
    }
    
}
