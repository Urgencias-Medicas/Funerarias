<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';
    public $fillable = ['funeraria', 'contenido', 'estatus', 'caso'];
    public $timestamps = false;
}
