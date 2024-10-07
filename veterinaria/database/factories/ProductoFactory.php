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
        $stockType = $this->faker->randomElement(['inyectable', 'comprimidos', 'granel']);

        $stockData = [];
        if ($stockType === 'comprimidos') {
            $stockData = [
                'stock_unidades' => $this->faker->randomNumber(1, 20),
                'comprimidos_por_caja' => $this->faker->randomNumber(2, 30),
            ];
            $stockData['stock_total_comprimidos'] = $stockData['stock_unidades'] * $stockData['comprimidos_por_caja'];
        } elseif ($stockType === 'granel') {
            $stockData = [
                'stock_unidades' => $this->faker->randomNumber(1, 20),
                'unidades_por_envase' => $this->faker->randomNumber(2, 30),
            ];
            $stockData['unidades_granel_total'] = $stockData['stock_unidades'] * $stockData['unidades_por_envase'];
        } elseif ($stockType === 'inyectable') {
            $stockData = [
                'stock_unidades' => $this->faker->randomNumber(1, 20),
                'ml_por_unidad' => $this->faker->randomNumber(1, 0.5, 30),
            ];
            $stockData['stock_total_ml'] = $stockData['stock_unidades'] * $stockData['ml_por_unidad'];
        }

        return array_merge([
            'nombre' => $this->faker->name(),
            'codigo' => $this->faker->unique()->randomNumber(9, true),
            'precio_de_compra' => $this->faker->numberBetween(1, 20000),
            'precio_de_venta' => $this->faker->numberBetween(1, 20000), 
            'id_unidad' => $this->faker->numberBetween(1, 4),
            'id_presentacion' => $this->faker->numberBetween(0, 3),
            'id_categoria' => $this->faker->numberBetween(1, 2),
            'fecha_de_vencimiento' => $this->faker->dateTimeBetween('now', '+1 years'),
            'cantidad_minima_requerida' => $this->faker->numberBetween(11, 99),
        ], $stockData);
    }
}
