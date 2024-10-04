<?php
// app/Models/Producto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    // Función para formatear el nombre del producto
    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtolower($value),
            get: fn($value) => ucfirst($value)
        );
    }
    //funcion para formatear la fecha de vencimiento
    protected function casts(): array
    {
        return [
            'fecha_de_vencimiento' => 'datetime:Y-m-d',
        ];
    }

    // Función para formatear los precios de compra y venta
    protected function precioDeCompra(): Attribute
    {
        return Attribute::make(
            set: fn($value) => number_format(str_replace([',', '.'], '', $value), 2, '.', ''),
            get: fn($value) => number_format($value, 0, '', '.')
        );
    }

    protected function precioDeVenta(): Attribute
    {
        return Attribute::make(
            set: fn($value) => number_format(str_replace([',', '.'], '', $value), 2, '.', ''),
            get: fn($value) => number_format($value, 0, '', '.')
        );
    }

    // Relación con la tabla categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}