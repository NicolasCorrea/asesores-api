<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Comunicaciones",
                'username' => "comunicaciones",
                'password' => Hash::make('Reg1234'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => "Gestión",
                'username' => 'gestion',
                'password' => Hash::make('Ges1234'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
    }
}
