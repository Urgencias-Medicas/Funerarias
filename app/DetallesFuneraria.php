<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesFuneraria extends Model
{
    protected $table = 'detalles_funeraria';
    public $fillable = ['Campos'];
    public $timestamps = false;
}
