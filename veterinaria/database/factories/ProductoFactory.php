<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'codigo' => $this->faker->unique()->randomNumber(),
            'precio_de_compra' => $this->faker->randomNumber(),
            'precio_de_venta' => $this->faker->randomNumber(),
            'id_unidad' => $this->faker->numberBetween(1, 4),
            'stock' => $this->faker->randomNumber(),
            'id_presentacion' => $this->faker->numberBetween(1, 10),
            'id_categoria' => $this->faker->numberBetween(1, 2),
            'fecha_de_vencimiento' => $this->faker->dateTime(),
            'cantidad_minima_requerida' => $this->faker->randomNumber(),
        ];
    }
}
