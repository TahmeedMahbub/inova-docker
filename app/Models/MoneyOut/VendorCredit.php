<?php

namespace App\Models\MoneyOut;

use App\Traits\QueryShorter;
use Illuminate\Database\Eloquent\Model;

class VendorCredit extends Model
{    
    use QueryShorter;
    protected $table = 'vendor_credit';

    public function vendor()
    {
      return $this->belongsTo('App\Models\Contact\Contact','vendor_name');
    }

    public function vendorCreditEntries()
    {
      return $this->hasMany('App\Models\MoneyOut\VendorCreditEntry');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function vendorCreditPayments()
    {
        return $this->hasMany('App\Models\MoneyOut\VendorCreditPayment','vendor_credit_id');
    }

    public function vendorCreditRefunds()
    {
        return $this->hasMany('App\Models\MoneyOut\VendorCreditRefund','vendor_credit_id');
    }

    public function item(){

    }
}
