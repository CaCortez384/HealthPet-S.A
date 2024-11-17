<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function availableTimes()
    {
        // Lógica para obtener los tiempos disponibles
        $events = [
            // Ejemplo de eventos
            ['12:30' => 'Disponible', 'start' => '2023-10-01T12:20:00', 'end' => '2023-10-01T13:00:00'],
            ['13:00' => 'Disponible', 'start' => '2023-10-01T13:00:00', 'end' => '2023-10-01T13:30:00'],
        ];

        return response()->json($events);
    }

}
