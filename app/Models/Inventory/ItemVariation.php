<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ItemVariation extends Model
{
    protected $table = 'item_variations';

    protected $fillable = [
        'variation_name',
        'carton_size',
        'variation_sales_rate',
        'variation_purchase_rate',
        'variation_about',
        'item_id',
        'sku',
        'status',
        'total_purchases',	
        'total_purchase_return',	
        'total_sales',	
        'total_sale_return',	
        'total_stock',	
        'total_damaged',	
        'total_manufacture',	
        'total_use',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }

    public function itemVariationAttributeValues()
    {
        return $this->hasMany('App\Models\Inventory\ItemVariationAttributeValues', 'item_variation_id');
    }

    public function billEntry()
    {
        return $this->hasMany('App\Models\MoneyOut\BillEntry', 'variation_id');
    }

    public function billFreeEntry()
    {
        return $this->hasMany('App\Models\MoneyOut\BillFreeEntry', 'free_item_variation_id');
    }

    public function creditNoteEntry()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNoteEntry', 'variation_id');
    }

    public function damageItems()
    {
        return $this->hasMany('App\Models\Inventory\DamageItem', 'variation_id');
    }    

    public function depoSaleEntry()
    {
        return $this->hasMany('App\Models\DepoSale\DepoSaleEntries', 'variation_id');
    }

    public function depoSaleFreeEntry()
    {
        return $this->hasMany('App\Models\DepoSale\DepoSaleFreeEntries', 'free_item_variation_id');
    }

    public function estimateEntry()
    {
        return $this->hasMany('App\Models\MoneyIn\Estimate_Entry', 'variation_id');
    }

    public function invoiceEntry()
    {
        return $this->hasMany('App\Models\MoneyIn\InvoiceEntry', 'variation_id');
    }

    public function invoiceFreeEntry()
    {
        return $this->hasMany('App\Models\MoneyIn\InvoiceFreeEntry', 'free_item_variation_id');
    }

    public function manufactureEntry()
    {
        return $this->hasMany('App\Models\Inventory\ManufactureEntry', 'variation_id');
    }

    public function manufacturePhaseDisburse()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseDisburse', 'variation_id');
    }

    public function manufacturePhaseRawMaterials()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseRawMaterials', 'variation_id');
    }

    public function manufacturePhaseReceiveFromFactory()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseReceiveFromFactory', 'variation_id');
    }

    public function offerBaseItemVariation()
    {
        return $this->hasMany('App\Models\Offers\Offers', 'item_variation_id');
    }

    public function offerFreeItemVariation()
    {
        return $this->hasMany('App\Models\Offers\Offers', 'free_item_variation_id');
    }

    public function vendorCreditEntry()
    {
        return $this->hasMany('App\Models\MoneyOut\VendorCreditEntry', 'variation_id');
    }

}
