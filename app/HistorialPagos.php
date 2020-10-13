<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialPagos extends Model
{
    protected $table = 'historial_pagos';
    public $fillable = ['caso', 'monto', 'fecha'];
    public $timestamps = false;
}
