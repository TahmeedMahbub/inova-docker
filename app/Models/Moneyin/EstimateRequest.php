<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class EstimateRequest extends Model
{
    protected $table = "estimate_request";

    protected $fillable = [
        'contact_id',
        'order_code',
        'request_date',
        'requirements',
        'note',
        'deadline_date',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'contact_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch', 'branch_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function estimateRequestModel()
    {
        return $this->hasMany('App\Models\Moneyin\EstimateRequestModel', 'estimate_request_id');
    }
}
