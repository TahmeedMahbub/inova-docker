<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class EstimateRequestModel extends Model
{
   protected $table= "estimate_request_model";

   protected $fillable = [
       'id',
       'estimate_request_id',
       'model_name',
       'created_by',
       'updated_by',
       'created_at',
       'updated_at',
    ];

    public function estimateRequest()
    {
        return $this->belongsTo('App\Models\Moneyin\EstimateRequest', 'estimate_request_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function estimateRequestModelEntries()
    {
        return $this->hasMany('App\Models\Moneyin\EstimateRequestModelEntries', 'estimate_request_model_id');
    }
    
}
