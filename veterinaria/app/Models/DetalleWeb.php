<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleWeb extends Model
{
    use HasFactory;

    protected $table = 'detalle_web';

    protected $fillable = [
        'id_producto',
        'marca',
        'descripcion',
        'imagen',
        'contenido_neto'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    
}
