<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    /**
     * Tabla
     */
    protected $table = 'pacientes';

    /**
     * Campos permitidos
     */
    protected $fillable = [

        // DATOS BÁSICOS
        'nombre',
        'edad',
        'nivel_tea',

        // COMUNICACIÓN
        'comunicacion_verbal',
        'p_comunicacion',

        // SOCIAL
        'interaccion_social',

        // SENSORIAL
        'brillo_pref',
        'contraste_pref',
        'color_fondo',
        'color_molesta',

        // IA
        'sugerencias_pictogramas',
        'imagen_personalizada',

        // AGENDAS
        'agenda_lunes',
        'agenda_martes',
        'agenda_miercoles',
        'agenda_jueves',
        'agenda_viernes',
        'agenda_sabado',
        'agenda_domingo',
    ];

    /**
     * Conversión automática
     */
    protected $casts = [

        // Convierte JSON → Array automáticamente
        'imagen_personalizada' => 'array',
    ];

    /**
     * Relación usuarios
     */
    public function usuarios()
    {
        return $this->hasMany(
            User::class,
            'paciente_id'
        );
    }

    /**
     * Relación seguimientos
     */
    public function seguimientos()
    {
        return $this->hasMany(
            Seguimiento::class,
            'paciente_id'
        );
    }

    /**
     * Agenda actual
     */
    public function pictogramasActuales()
    {
        $dias = [

            'Monday'    => 'agenda_lunes',
            'Tuesday'   => 'agenda_martes',
            'Wednesday' => 'agenda_miercoles',
            'Thursday'  => 'agenda_jueves',
            'Friday'    => 'agenda_viernes',
            'Saturday'  => 'agenda_sabado',
            'Sunday'    => 'agenda_domingo',
        ];

        $diaActual = date('l');

        $campo = $dias[$diaActual]
            ?? 'agenda_lunes';

        return $this->$campo;
    }
}

