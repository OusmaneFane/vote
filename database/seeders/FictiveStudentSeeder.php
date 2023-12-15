<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FictiveStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('students')->insert([
                'matricule' => '0000000',
                'password' =>'00000000',
                // Ajoutez d'autres colonnes nécessaires ici
            ]);
    }
}
