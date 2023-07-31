<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class BillOfMaterial extends Model
{
    protected $table = 'bill_of_materials';

    protected $fillable = ['invoice_id', 'item_id', 'project_name', 'product_size', 'date', 'quantity','cho_percent','profit_percent','design_percent','sub_total','mrp_percent','vat_percent','status','trade_total','created_by','updated_by','created_at','updated_at'];


    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function billOfMaterialEntries()
    {
        return $this->hasMany('App\Models\Moneyin\BillOfMaterialEntry');
    }

}
