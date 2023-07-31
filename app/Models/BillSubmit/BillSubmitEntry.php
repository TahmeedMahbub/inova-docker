<?php

namespace App\Models\BillSubmit;

use Illuminate\Database\Eloquent\Model;

class BillSubmitEntry extends Model
{
    protected $table = 'bill_submit_entries';

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_submit_id');
    }

    public function accountName()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }

    public function currencySymbol()
    {
        return $this->belongsTo('App\Models\Setting\Currency\SettingCurrency', 'setting_currencies_id');
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
