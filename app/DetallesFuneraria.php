<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesFuneraria extends Model
{
    protected $table = 'detalles_funeraria';
    public $fillable = ['paso_uno', 'paso_dos', 'paso_tres'];
    public $timestamps = false;
}
