<?php

namespace App\Models\DistributorSale;

use Illuminate\Database\Eloquent\Model;

class DistributorSale extends Model
{
    protected $table = 'distributor_sales';

    protected $fillable = [
        'id',
        'sales_number',
        'seller_id',
        'customer_id',
        'branch_id',
        'sales_date',
        'reference',
        'description',
        'amount',
        'adjustment',
        'adjustment_type',
        'shipping_charge',
        'tax_total',
        'personal_note',
        'file_url',
        'file_name',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
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
        return $this->belongsTo('App\Models\Branch\Branch','branch_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact','customer_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\Models\Contact\Contact','seller_id');
    }
}
