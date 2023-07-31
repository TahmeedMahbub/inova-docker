<?php

namespace App\Imports;

use App\Models\Contact\Contact;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $contact = new Contact;

        $contact->first_name    = $row[0];
        $contact->last_name     = $row[1];
        $contact->display_name  = $row[2];
        $contact->email         = $row[3];
        $contact->mobile        = $row[4];
        $contact->address       = $row[5];

        $contact->save();

        return $contact;
    }
}
