<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Presentacion extends Model
{
    use HasFactory;

    protected $table = 'presentacion';

    // Función para formatear el nombre del producto
    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value)
        );
    }
    // Relación con la tabla producto
    public function productos()
    {
        return $this->hasOne(Producto::class, 'id_presentacion')->select('nombre');
    }


}
