<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    protected $table = 'casos';
    public $fillable = ['Codigo', 'Nombre', 'Fecha', 'Hora', 'Motivo', 'Direccion', 'Departamento', 'Municipio', 'Padre', 'TelPadre', 'Madre', 'TelMadre', 'NombreReporta', 'RelacionReporta', 'TelReporta', 'LugarCuerpo', 'Funeraria', 'Estatus', 'Reportar', 'ServicioFunerarioContratado', 'Costo', 'Pagado', 'Solicitud', 'Idioma', 'Medico', 'Tutor', 'TelTutor', 'DPITutor', 'ParentescoTutor', 'EmailTutor', 'Comentario'];
    public $timestamps = false;
}
