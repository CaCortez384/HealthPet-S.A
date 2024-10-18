<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Producto;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    // Pasar los productos bajo stock a todas las vistas que usan el layout
    View::composer('components.app-layout', function ($view) {
        // Obtener productos con stock por debajo del mínimo requerido
        $productosBajoStock = Producto::whereColumn('stock_unidades', '<', 'cantidad_minima_requerida')->get();

        // Pasar la variable a la vista
        $view->with('productosBajoStock', $productosBajoStock);
    });


        Paginator::useBootstrap(); // Asegúrate de que Bootstrap esté cargado en tu vista
        //
    }
}
