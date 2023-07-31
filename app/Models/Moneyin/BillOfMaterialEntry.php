<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class BillOfMaterialEntry extends Model
{
    protected $table = 'bill_of_material_entries';

    protected $fillable = ['bill_of_material_id','item_id','sub_category_id','quantity','wastage_percent','unit_id','unit_price'];
    
    public $timestamps = false;
    
    public function bill_of_material()
    {
        return $this->belongsTo('App\Models\Moneyin\BillOfMaterial','bill_of_material_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Inventory\ItemSubCategory','sub_category_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Setting\Unit','unit_id');
    }

    // public function billOfMaterialEntries()
    // {
    //     return $this->belongsTo('App\Models\Moneyin\BillOfMaterial','bill_of_material_id');
    // }

}
