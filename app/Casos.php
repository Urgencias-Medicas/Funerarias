<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    protected $table = 'casos';
    public $fillable = ['Codigo', 'Edad', 'Agente', 'Nombre', 'Aseguradora', 'Nombre_Aseguradora', 'Fecha', 'Hora', 'Causa', 'Causa_Desc', 'Causa_Especifica', 'Direccion', 'Departamento', 'Municipio', 'Padre', 'TelPadre', 'Madre', 'TelMadre', 'NombreReporta', 'RelacionReporta', 'TelReporta', 'Lugar', 'Funeraria', 'Funeraria_Nombre', 'Estatus', 'Reportar', 'ServicioFunerarioContratado', 'Costo', 'Moneda', 'Pagado', 'Solicitud', 'Idioma', 'Medico', 'Tutor', 'TelTutor', 'DPITutor', 'ParentescoTutor', 'EmailTutor', 'Comentario', 'Evaluacion'];
    public $timestamps = false;
}
