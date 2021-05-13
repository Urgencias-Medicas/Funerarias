<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialPagos extends Model
{
    protected $table = 'historial_pagos';
    public $fillable = ['caso', 'monto', 'fecha', 'factura', 'serie', 'comprobante'];
    public $timestamps = false;
}
