<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funerarias extends Model
{
    protected $table = 'funerarias';
    public $fillable = ['Id_Funeraria', 'Funeraria_Registrada', 'Nombre', 'Diminutivo', 'Email', 'Telefono', 'Monto_Base', 'Activa', 'Id_Detalle', 'Campanias'];
    public $timestamps = false;
}
