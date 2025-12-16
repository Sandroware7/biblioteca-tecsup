<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@tecsup.edu.pe',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Estudiante Ejemplo',
            'email' => 'alumno@tecsup.edu.pe',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        \App\Models\User::factory(10)->create();
    }
}
