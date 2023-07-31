<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class StockSerial extends Model
{
    protected $table = 'stock_serial';

    public function billEntry()
    {
        return $this->belongsTo('App\Models\MoneyOut\BillEntry','bill_entry_id');
    }

     public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function stockSerial()
    {
        return $this->belongsTo('App\Models\MoneyOut\StockSerial','serial', 'serial');
    }
    public function stock_serial_status()
    {
       return $this->belongsTo('App\Models\Inventory\StockSerialStatus', 'stock_status');
    }
}
