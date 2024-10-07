<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Presentacion;
use App\Models\Unidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        Producto::factory()->count(40)->create();
        // Categoria::factory()->create();
        // Presentacion::factory()->create();
        // Unidad::factory()->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456',
            'role' => 'admin,'
        ]);

        Categoria::factory()->createMany([
            ['nombre' => 'web'],
            ['nombre' => 'local'],
        ]);

        Presentacion::factory()->createMany([
            ['nombre' => 'comprimidos'],
            ['nombre' => 'inyectable'],
            ['nombre' => 'granel'],

        ]);

        Unidad::factory()->createMany([
            ['nombre' => 'miligramos'],
            ['nombre' => 'gramos'],
            ['nombre' => 'kilogramos'],
            ['nombre' => 'mililitros'],
            ['nombre' => 'litros'],
        ]);
    }
}
