<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Unidad extends Model
{
    use HasFactory;
    protected $table = 'unidad';

    public function productos() {
        return $this->hasMany(Producto::class, 'id_unidad');
    }

    public function getNombreCapitalizado() {
        return ucfirst($this->nombre);
    }
    
    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value)
        );
    }
}
