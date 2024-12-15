<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = ['service_id', 'name', 'phone', 'email', 'patient_type', 'description', 'appointment_time'];

    public function service()
    {
        return $this->belongsTo(Servicio::class);
    }
}
