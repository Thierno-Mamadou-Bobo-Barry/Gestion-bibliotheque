<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Admin + Bibliothécaire
        $this->call(AdminSeeder::class);

        // 2) Un lecteur de test
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'login' => 'ETU202401',
            'email' => 'test@example.com',
            'role' => 'Rlecteur',
            'actif' => true,
        ]);
    }
}
