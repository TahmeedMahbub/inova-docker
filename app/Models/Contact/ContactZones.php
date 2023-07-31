<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactZones extends Model
{
    protected $table = 'contact_zones';


    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
