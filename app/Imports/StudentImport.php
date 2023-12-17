<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Classe;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $classeName = $row['classe'];
        $classe = Classe::where('name', $classeName)->first();

        // Créez un nouvel étudiant en attribuant l'ID de la classe
        return new Student([
            'matricule' => $row['matricule'],
            'password' => $row['password'],
            'classe_id' => $classe ? $classe->id : null,
        ]);    
    }
}
