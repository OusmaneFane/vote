<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for ($i = 1; $i <= 3; $i++) {
            DB::table('admins')->insert([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => Hash::make('admin123'), // Vous pouvez changer le mot de passe selon vos besoins
                'user_type' => 'Administrator', // Ajoutez la colonne user_type
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
