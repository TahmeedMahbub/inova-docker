<?php

namespace App\Models\Attributes;

use App\Models\Inventory\ItemAttributeValues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Attributes extends Model
{
    protected $table = 'attributes';

    protected $fillable = [
        'name',
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
        return $this->hasMany('App\Models\Attributes\AttributeValues','attribute_id');
    }

    public function itemVariationAttributeValues()
    {
        return $this->hasMany('App\Models\Inventory\ItemVariationAttributeValues', 'attribute_id');
    }
    
    public function itemAttributeValues(): HasManyThrough
    {
        return $this->hasManyThrough(ItemAttributeValues::class, AttributeValues::class);
    }

    // public function ItemAttributeValues()
    // {        
    //     return $this->hasMany('App\Models\Inventory\ItemAttributeValues', 'attribute_id');
    // }
    
}
