<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class DepoStock extends Model
{
    protected $table = 'depo_stock';

    protected $fillable = [
        'id',
        'invoice_entries_id',
        'depo_id',
        'item_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
    
    public function invoiceEntry()
    {
        return $this->belongsTo('App\Models\Inventory\InvoiceEntry', 'invoice_entries_id');
    }

    public function depo()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'depo_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
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
