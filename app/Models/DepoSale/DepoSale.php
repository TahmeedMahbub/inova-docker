<?php

namespace App\Models\DepoSale;

use Illuminate\Database\Eloquent\Model;

class DepoSale extends Model
{
    protected $table = 'depo_sales';

    protected $fillable = [
        'sales_number',
        'sales_date',
        'seller_id',
        'customer_id',
        'branch_id',
        'personal_note',
        'file_name',
        'file_url',
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

    public function depoSaleEntries()
    {
        return $this->hasMany('App\Models\DepoSale\DepoSaleEntries','depo_sales_id');
    }

    public function depoSaleFreeEntries()
    {
        return $this->hasMany('App\Models\DepoSale\DepoSaleFreeEntries','depo_sales_id');
    }
}
