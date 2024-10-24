<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Especie;
use App\Models\Presentacion;
use App\Models\Unidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        
        Producto::factory()->count(40)->create();
        // Categoria::factory()->create();
        // Presentacion::factory()->create();
        // Unidad::factory()->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456',
            'role' => 'admin'
        ]);

        Categoria::factory()->createMany([
            ['nombre' => 'Medicamento'],
            ['nombre' => 'Alimento'],
            ['nombre' => 'Accesorio'],
            
        ]);

        Especie::factory()->createMany([
            ['nombre' => 'Perro'],
            ['nombre' => 'Gato'],
            ['nombre' => 'Otro'],
        ]);

        Presentacion::factory()->createMany([
            ['nombre' => 'comprimidos', 'id_categoria' => 1],
            ['nombre' => 'inyectable', 'id_categoria' => 1],
            ['nombre' => 'granel', 'id_categoria' => 1],

            ['nombre' => 'Seco', 'id_categoria' => 2],
            ['nombre' => 'Humedo', 'id_categoria' => 2],
            ['nombre' => 'Snack', 'id_categoria' => 2],

            ['nombre' => 'juguete', 'id_categoria' => 3],
            ['nombre' => 'estetica e higiene', 'id_categoria' => 3],
            ['nombre' => 'ropa', 'id_categoria' => 3],
            ['nombre' => 'otro', 'id_categoria' => 3],
        ]);

        Unidad::factory()->createMany([
            ['nombre' => 'miligramos'],
            ['nombre' => 'gramos'],
            ['nombre' => 'kilogramos'],
            ['nombre' => 'mililitros'],
            ['nombre' => 'litros'],
        ]);


        DB::table('tipo_pago')->insert([
            ['nombre' => 'Efectivo', 'descripcion' => 'Pago en efectivo'],
            ['nombre' => 'Tarjeta de Crédito', 'descripcion' => 'Pago con tarjeta de crédito'],
            ['nombre' => 'Tarjeta de Débito', 'descripcion' => 'Pago con tarjeta de débito'],
            ['nombre' => 'Transferencia Bancaria', 'descripcion' => 'Pago mediante transferencia bancaria'],
        ]);
    }
}
