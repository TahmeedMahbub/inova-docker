<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ProductTransfer extends Model
{   
    protected $table = 'product_transfers';

    public function representative()
    {
      return $this->belongsTo('App\Models\Contact\Contact','sr_id');
    }

    public function product_status()
    {
      return $this->belongsTo('App\Models\Inventory\StockSerialStatus','status');
    }

    public function stockSerial()
    {
        return $this->belongsTo('App\Models\MoneyOut\StockSerial','serial', 'serial');
    }
    public function branch(){
        
      return $this->hasOne('App\Models\Branch\Branch','branch_id');
    }
    public function user()
    {
      return $this->belongsTo('App\User', 'sr_id');
    }
    

}
