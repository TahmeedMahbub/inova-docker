<?php

namespace App\Models\Bank;

use Illuminate\Database\Eloquent\Model;

class ChequeBook extends Model
{
    protected $table = 'cheque_book';

    protected $fillable = [
        'book_collection_date',
        'bank_id',
        'start_page_no',
        'number_of_pages',
        'branch_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at	',
    ];

    public function bank()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'bank_id');
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
}
