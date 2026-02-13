<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['login' => 'ADM001'],
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => Hash::make('password'),
                'role' => 'Radmin',
                'actif' => true,
            ]
        );

        User::updateOrCreate(
            ['login' => 'BIB001'],
            [
                'name' => 'Bibliothecaire',
                'email' => 'bib@demo.com',
                'password' => Hash::make('password'),
                'role' => 'Rbibliothecaire',
                'actif' => true,
            ]
        );
    }
}
