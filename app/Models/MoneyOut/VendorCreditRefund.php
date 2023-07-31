<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class VendorCreditRefund extends Model
{   protected $table = 'vendor_credit_refunds';
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

     public function VendorCredit()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNote','credit_note_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo('App\Models\PaymentMode\PaymentMode','payment_mode_id');
    }
}
