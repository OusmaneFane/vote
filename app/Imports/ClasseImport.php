<?php

namespace App\Imports;

use App\Models\Classe;
use Maatwebsite\Excel\Concerns\ToModel;

class ClasseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Classe([
            'name'     => $row[0],
            'description'    => $row[1],

        ]);
    }
}
