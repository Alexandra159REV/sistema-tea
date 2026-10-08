<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = 'seguimientos';

    protected $fillable = [
        'paciente_id',
        'autonomia',
        'comunicacion',
        'estabilidad',
        'compromiso',
        'consistencia'
    ];

    // Esto es CRÍTICO para que el gráfico de líneas funcione con fechas
    protected $casts = [
        'created_at' => 'datetime',
    ];
}