<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComprobantesUM extends Model
{
    protected $table = 'historial_comprobantes';
    public $fillable = ['caso', 'ruta'];
    public $timestamps = false;
}
