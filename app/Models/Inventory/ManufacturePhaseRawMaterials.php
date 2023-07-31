<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ManufacturePhaseRawMaterials extends Model
{
    protected $table = 'manufacture_phase_raw_materials';
    protected $fillable = [
        'manufacture_phase_id',
        'item_id',
        'variation_id',
        'quantity',
        'unit_id',
        'basic_unit_conversion',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    
    public function manufacturePhase()
    {
        return $this->belongsTo('App\Models\Inventory\ManufacturePhase','manufacture_phase_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }
    
    public function variation()
    {
        return $this->belongsTo('App\Models\Inventory\ItemVariation','variation_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
