<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funerarias extends Model
{
    protected $table = 'funerarias';
    public $fillable = ['Id_Funeraria', 'Nombre', 'Email', 'Telefono', 'Monto_Base', 'Activa', 'Id_Detalle'];
    public $timestamps = false;
}
