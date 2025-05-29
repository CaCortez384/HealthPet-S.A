<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'deuda_id',
        'monto_pagado',
        'fecha_pago',
        'tipo_pago_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d',
          
        ];
    }

    public function getTotalAttribute($value)
    {
        return '$' . number_format($value, 0, ',', '.');
    }

    // Relación con la tabla deudas
    public function deuda()
    {
        return $this->belongsTo(Deuda::class, 'deuda_id');
    }

    // Relación con la tabla tipo_pago
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }
}
