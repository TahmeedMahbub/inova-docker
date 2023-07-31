<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ManufacturePhase extends Model
{
    protected $table = 'manufacture_phases';
    protected $fillable = [
        'id',
        'phase_name',
        'manufacture_id',
        'factory_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    public function factory()
    {
        return $this->belongsTo('App\Models\Contact\Contact','factory_id');
    }

    public function manufacture()
    {
        return $this->belongsTo('App\Models\Inventory\Manufacture','manufacture_id');
    }

    public function manufacturePhaseRawMaterials()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseRawMaterials','manufacture_phase_id');
    }

    public function manufacturePhaseDisburses()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseDisburse','manufacture_phase_id');
    }

    public function manufacturePhaseReceivesFromFactory()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseReceiveFromFactory','manufacture_phase_id');
    }
   
}
