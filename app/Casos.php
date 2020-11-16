<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    protected $table = 'casos';
    public $fillable = ['Codigo', 'Agente', 'Nombre', 'Fecha', 'Hora', 'Causa', 'Causa_Desc', 'Direccion', 'Departamento', 'Municipio', 'Padre', 'TelPadre', 'Madre', 'TelMadre', 'NombreReporta', 'RelacionReporta', 'TelReporta', 'Lugar', 'Funeraria', 'Funeraria_Nombre', 'Estatus', 'Reportar', 'ServicioFunerarioContratado', 'Costo', 'Pagado', 'Solicitud', 'Idioma', 'Medico', 'Tutor', 'TelTutor', 'DPITutor', 'ParentescoTutor', 'EmailTutor', 'Comentario', 'Evaluacion'];
    public $timestamps = false;
}
