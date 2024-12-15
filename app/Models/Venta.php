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

    protected function casts(): array
    {
        return [
            'fecha_venta' => 'datetime:Y-m-d',

        ];
    }

    public function getTotalAttribute($value)
    {
        return $value; // Regresa el valor numérico sin formato
    }


    public function setRutClienteAttribute($value)
    {
        $this->attributes['rut_cliente'] = str_replace('-', '', $value);
    }

    public function scopeByRutCliente($query, $rut)
    {
        return $query->where('rut_cliente', str_replace('-', '', $rut));
    }

    public function tipoPago()
    {

        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }
}
