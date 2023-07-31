<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class EstimateRequestModelEntries extends Model
{
    protected $table = "estimate_request_model_entries";

    protected $fillable = [
        'id',
        'estimate_request_model_id',
        'size',
        'color',
        'quantity',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function estimateRequestModel()
    {
        return $this->belongsTo('App\Models\Moneyin\EstimateRequestModel', 'estimate_request_model_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
