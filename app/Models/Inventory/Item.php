<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'barcode_no',	
        'item_name',	
        'item_about',	
        'item_sales_rate',	
        'item_sales_account',	
        'item_sales_description',	
        'item_sales_tax',	
        'item_purchase_rate',	
        'item_purchase_account',	
        'item_purchase_description',	
        'reorder_point',	
        'barcode',	
        'item_image_url',	
        'total_purchases',	
        'total_sales',	
        'total_stock',	
        'unit_type',	
        'carton_size',	
        'item_category_id',	
        'item_sub_category_id',	
        'branch_id',	
        'created_by',	
        'updated_by',	
        'created_at',	
        'updated_at',	
        'company_id',	
        'subject_name',	
        'total_manufacture',	
        'total_use',	
        'total_purchase_return',	
        'total_sale_return',	
        'total_damaged'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch');
    }

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\Inventory\ItemCategory');
    }
    
    public function itemSubCategory()
    {
        return $this->belongsTo('App\Models\Inventory\ItemSubCategory');
    }

    public function purchaseAccount()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'item_purchase_account');
    }

    public function salesAccount()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'item_sales_account');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Inventory\Stock', 'item_id');
    }
    
    public function invoiceEntries()
    {
        return $this->hasMany('App\Models\Moneyin\InvoiceEntry','item_id');
    }

    public function billEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\BillEntry','item_id');
    }

    public function creditNoteEntries()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNoteEntry','item_id');
    }

    public function vendorCreditEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\VendorCreditEntry','item_id');
    }

    public function itemVariations()
    {
        return $this->hasMany('App\Models\Inventory\ItemVariation', 'item_id');
    }

    public function itemOffers()
    {
        return $this->hasMany('App\Models\Offers\Offers', 'item_id')->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>', date('Y-m-d'));
    }

    public function itemFreeOffers()
    {
        return $this->hasMany('App\Models\Offers\Offers', 'free_item_id');
    }

    public function invoiceFreeEntries()
    {
        return $this->hasMany('App\Models\Moneyin\InvoiceFreeEntry', 'free_item_id');
    }

    public function billFreeEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\BillFreeEntry', 'free_item_id');
    }

    public function damage()
    {
        return $this->hasMany('App\Models\Inventory\DamageItem', 'item_id');
    }

    public function depoSaleEntries()
    {
        return $this->hasMany('App\Models\DepoSale\DepoSaleEntries', 'item_id');
    }

    public function depoSalesFreeEntries()
    {
        return $this->hasMany('App\Models\DepoSale\DepoSaleFreeEntries', 'free_item_id');
    }

    public function estimateEntries()
    {
        return $this->hasMany('App\Models\Moneyin\Estimate_Entry', 'item_id');
    }

    public function manufactureEntries()
    {
        return $this->hasMany('App\Models\Inventory\ManufactureEntry', 'item_id');
    }

    public function manufacturePhaseDisburse()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseDisburse', 'item_id');
    }

    public function manufacturePhaseReceiveFromFactory()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseReceiveFromFactory', 'item_id');
    }

    public function manufacturePhaseRawMaterial()
    {
        return $this->hasMany('App\Models\Inventory\ManufacturePhaseRawMaterials', 'item_id');
    }

    public function stockTransfer()
    {
        return $this->hasMany('App\Models\Inventory\StockTransfer', 'item_id');
    }

    public function ItemAttributeValues()
    {
        return $this->hasMany('App\Models\Inventory\ItemAttributeValues', 'item_id')->with('attributeValues');
    }
    public function Unit(){

        return $this->hasOne('App\Models\Setting\Unit','id', 'unit_id');
    }
    public function itemMultipleFiles()
    {
        return $this->hasMany('App\Models\Inventory\ItemMultipleFile','item_id');
    }

}
