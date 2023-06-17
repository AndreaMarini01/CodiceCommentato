<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class seeder_utenti extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nome' => 'Matteo',
            'email' => 'matteo@example.com',
            'password' => Hash::make('A3GgKE9M'),
            'telefono' => '123456789',
            'datadinascita' => '1990-01-01',
            'username' => 'adminadmin',
            'cognome' => 'Mori',
            'genere' => 'Male',
            'role' => 'admin',

        ]);

        DB::table('users')->insert([
            'nome' => 'Matteo',
            'email' => 'matteo2@example.com',
            'password' => Hash::make('A3GgKE9M'),
            'telefono' => '987654321',
            'datadinascita' => '1995-05-15',
            'username' => 'staffstaff',
            'cognome' => 'Rossi',
            'genere' => 'Female',
            'role' => 'staff',

        ]);

        DB::table('users')->insert([
            'nome' => 'Mario',
            'email' => 'mario@example.com',
            'password' => Hash::make('A3GgKE9M'),
            'telefono' => '123456789',
            'datadinascita' => '2000-08-25',
            'username' => 'useruser',
            'cognome' => 'Rossi',
            'genere' => 'Male',
            'role' => 'user',

        ]);


    }
}
