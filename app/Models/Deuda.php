<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;

    protected $fillable = [
        'venta_id',
        'monto_adeudado',
        'estado',
    ];

    // Relación con la tabla ventas
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    // Relación con la tabla pagos
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'deuda_id');
    }

    // Relación con la tabla tipo_pago
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }

    

    
}
