<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cliente',
        'rut_cliente',
        'total',
        'fecha_venta'
    ];

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

}
