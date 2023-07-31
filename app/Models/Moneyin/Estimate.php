<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $table ="estimates";

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'customer_id');
    }

    public function estimattedBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function estimateEntries()
    {
        return $this->hasMany('App\Models\Moneyin\Estimate_Entry', 'estimate_id');
    }
}
