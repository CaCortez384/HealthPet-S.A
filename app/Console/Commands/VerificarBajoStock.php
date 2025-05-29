<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto; // Asegúrate de que esta ruta sea correcta
use App\Mail\BajoStockNotification;
use Illuminate\Support\Facades\Mail;

class VerificarBajoStock extends Command
{
    // Definir la firma del comando
    protected $signature = 'stock:verificar';

    // Descripción del comando
    protected $description = 'Verifica productos con bajo stock y envía correos';

    // Método que se ejecuta cuando se invoca el comando
    public function handle()
    {
        // Obtener productos con stock por debajo del mínimo requerido
        // Cambiar 'stock_unidades' a 'stock' para reflejar el nombre correcto de la columna
        $productosBajoStock = Producto::whereColumn('stock_unidades', '<', 'cantidad_minima_requerida')->get();

        // Verifica si hay productos con bajo stock
        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock.');
        } else {
            // Muestra la lista de productos con bajo stock en la consola
            $this->info('Productos con bajo stock:');
            foreach ($productosBajoStock as $producto) {
                // Cambiar 'stock_unidades' a 'stock' y asegurarse de que los campos sean correctos
                $this->info("- {$producto->nombre} (Stock: {$producto->stock_unidades}, Mínimo requerido: {$producto->cantidad_minima_requerida})");
            }

            // Especifica el correo electrónico al que deseas enviar las notificaciones
            $destinatario = 'healtpet2024@gmail.com'; // Cambia esto por la dirección de correo real

            // Enviar un correo con la lista de productos de bajo stock
            Mail::to($destinatario)->send(new BajoStockNotification($productosBajoStock));

            // Confirmación en consola de que los correos fueron enviados
            $this->info('Correos enviados para productos con bajo stock.');
        }
    }
}
