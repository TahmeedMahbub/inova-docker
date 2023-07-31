<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class VendorCreditPayment extends Model
{
    protected $table = 'vendor_credit_payments';

    public function vendorCredit()
    {
        return $this->belongsTo('App\Models\MoneyOut\VendorCredit');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill');
    }
}
