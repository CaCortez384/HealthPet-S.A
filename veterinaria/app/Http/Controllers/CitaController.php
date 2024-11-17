<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Servicio;

class CitaController extends Controller
{

    public function create()
    {
        $servicios = Servicio::all();
        return view('citas.create', compact('servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required',
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|max:255',
            'tipo_paciente' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
            'hora_cita' => 'required|date',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index');
    }
}
