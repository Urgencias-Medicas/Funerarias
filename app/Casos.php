<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    protected $table = 'casos';
    public $fillable = ['Codigo', 'Nombre', 'Fecha', 'Hora', 'Causa', 'Direccion', 'Departamento', 'Municipio', 'Padre', 'Madre', 'Lugar', 'Funeraria', 'Estatus', 'Reportar'];
    public $timestamps = false;
}
