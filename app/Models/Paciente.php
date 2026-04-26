<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente (Mass Assignment).
     * Se han incluido los campos de ajustes sensoriales y la agenda completa.
     */
    protected $fillable = [
        'nombre', 
        'edad', 
        'nivel_tea', 
        'comunicacion_verbal', 
        'interaccion_social',
        
        // Ajustes Sensoriales (Basados en la Prueba de la Rana)
        'brillo_pref', 
        'contraste_pref', 
        'color_fondo', 
        'color_molesta',
        
        // Resultados de la IA
        'sugerencias_pictogramas',

        // Agenda Semanal Completa
        'agenda_lunes', 
        'agenda_martes', 
        'agenda_miercoles',
        'agenda_jueves',
        'agenda_viernes',
        'agenda_sabado',
        'agenda_domingo',
    ];

    /**
     * Relación: Un paciente puede tener muchos usuarios (padres, médicos).
     * Conecta con la columna 'paciente_id' en la tabla de usuarios en HeidiSQL.
     */
    public function usuarios() 
    {
        return $this->hasMany(User::class, 'paciente_id');
    }

    /**
     * Retorna la agenda del día actual para mostrarla en el perfil.
     * Esto soluciona el error BadMethodCallException en la vista.
     */
    public function pictogramasActuales()
    {
        // Obtenemos el nombre del día en español (o inglés según tu config)
        $dias = [
            'Monday'    => 'agenda_lunes',
            'Tuesday'   => 'agenda_martes',
            'Wednesday' => 'agenda_miercoles',
            'Thursday'  => 'agenda_jueves',
            'Friday'    => 'agenda_viernes',
            'Saturday'  => 'agenda_sabado',
            'Sunday'    => 'agenda_domingo',
        ];

        $diaActual = date('l'); // Ej: "Monday"
        $campo = $dias[$diaActual] ?? 'agenda_lunes';

        // Retornamos el contenido del campo de la agenda para hoy
        // Esto permite que el bucle en tu Blade (línea 251) tenga datos que procesar
        return $this->$campo;
    }
}