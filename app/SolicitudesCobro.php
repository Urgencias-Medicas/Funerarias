<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudesCobro extends Model
{
    protected $table = 'solicitudes_cobro_funerarias';
    public $fillable = ['caso', 'estatus', 'costo', 'descripcion'];
    public $timestamps = false;
}
