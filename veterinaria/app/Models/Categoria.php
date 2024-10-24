<?php
// app/Models/Categoria.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';

    // Relación com latabla producto
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value)
        );
    }

    // Relación con la tabla presentacion
    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class, 'id_presentacion');
    }
}