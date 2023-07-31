<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ItemMultipleFile extends Model
{
    protected $table = 'item_multiple_files';

    protected $fillable = [
        'item_id',	
        'sop_file',	
        'design_file',	
        'created_by',	
        'updated_by',	
        'created_at',	
        'updated_at',	
       
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }
  
}
