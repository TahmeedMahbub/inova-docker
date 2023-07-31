<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    //
    protected $table = 'manufacture';
    protected $fillable = [
        'id',
        'bill_of_material_id',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    public function manufacturePhases()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhase', 'manufacture_id');
    }
    public function manufactureEntries()
    {
        return $this->hasMany('App\Models\Inventory\ManufactureEntry', 'manufacture_id');
    }
    public function billOfMaterial()
    {
        return $this->belongsTo('App\Models\Moneyin\BillOfMaterial', 'bill_of_material_id');
    }
}
