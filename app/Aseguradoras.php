<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aseguradoras extends Model
{
    protected $table = 'aseguradoras';
    public $fillable = ['Nombre'];
    public $timestamps = false;
}
