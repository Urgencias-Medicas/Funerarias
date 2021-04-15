<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campanias extends Model
{
    protected $table = 'campanias';
    public $fillable = ['Nombre', 'Aseguradora', 'Nombre_Aseguradora', 'Moneda'];
    public $timestamps = false;
}
