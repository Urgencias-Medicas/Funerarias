<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    public $fillable = ['opcion', 'valor'];
    public $timestamps = false;
}
