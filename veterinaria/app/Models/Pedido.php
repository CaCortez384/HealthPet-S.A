<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'fecha',
        'total',
        'estado',
        'tipo_pago_id',
        'user_id',
    ];


    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }



    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }


    
}
