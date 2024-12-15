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
        $idCategoria = $this->faker->numberBetween(1, 3);
        $stockType1 = $this->faker->randomElement(['inyectable', 'comprimidos', 'granel']);

        $idPresentacion = match ($idCategoria) {
            1 => match ($stockType1) {
                'inyectable' => 1,
                'comprimidos' => 2,
                'granel' => 3,
            },
            2 => $this->faker->numberBetween(4, 6),
            3 => $this->faker->numberBetween(7, 10),
        };

        $stockData = [];    
        if ($idPresentacion == 1) {
            $stockData = [
                'stock_unidades' => $this->faker->numberBetween(1, 20),
                'comprimidos_por_caja' => $this->faker->numberBetween(2, 30),
                'precio_fraccionado' => $this->faker->numberBetween(1, 20000),
            ];
            $stockData['stock_total_comprimidos'] = $stockData['stock_unidades'] * $stockData['comprimidos_por_caja'];
        } elseif ($idPresentacion == 2) {
            $stockData = [
                'stock_unidades' => $this->faker->numberBetween(1, 20),
                'unidades_por_envase' => $this->faker->numberBetween(2, 30),
                'precio_fraccionado' => $this->faker->numberBetween(1, 20000),

            ];
            $stockData['unidades_granel_total'] = $stockData['stock_unidades'] * $stockData['unidades_por_envase'];
        } elseif ($idPresentacion == 3) {
            $stockData = [
                'stock_unidades' => $this->faker->numberBetween(1, 20),
                'ml_por_unidad' => $this->faker->randomFloat(1, 0.5, 30),
                'precio_fraccionado' => $this->faker->numberBetween(1, 20000),

            ];
            $stockData['stock_total_ml'] = $stockData['stock_unidades'] * $stockData['ml_por_unidad'];
        }

        $idPresentacion = match ($idCategoria) {
            1 => match ($stockType1) {
                'inyectable' => 1,
                'comprimidos' => 2,
                'granel' => 3,
            },
            2 => $this->faker->numberBetween(4, 6),
            3 => $this->faker->numberBetween(7, 10),
        };

        return array_merge([
            'nombre' => $this->faker->name(),
            'codigo' => $this->faker->unique()->randomNumber(9, true),
            'precio_de_compra' => $this->faker->numberBetween(1, 20000),
            'precio_de_venta' => $this->faker->numberBetween(1, 20000),
            'id_unidad' => $this->faker->numberBetween(1, 4),
            'id_presentacion' => $idPresentacion,
            'id_categoria' => $idCategoria,
            'id_especie' => $this->faker->numberBetween(1, 3), // Asegúrate de que este rango sea correcto
            'fecha_de_vencimiento' => $this->faker->dateTimeBetween('now', '+1 years'),
            'cantidad_minima_requerida' => $this->faker->numberBetween(11, 99),
        ], $stockData);
    }
}
