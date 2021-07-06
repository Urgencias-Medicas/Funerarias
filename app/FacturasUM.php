<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturasUM extends Model
{
    protected $table = 'historial_facturas';
    public $fillable = ['caso', 'ruta', 'estatus'];
    public $timestamps = false;
}
