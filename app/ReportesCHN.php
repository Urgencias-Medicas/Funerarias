<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportesCHN extends Model
{
    protected $table = 'reportes_chn';
    public $fillable = ['caso', 'ruta'];
    public $timestamps = false;
}
