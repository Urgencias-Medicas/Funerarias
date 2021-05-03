<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesDeFuneraria extends Model
{
    protected $table = 'detalle_de_funerarias';
    public $fillable = ['Funeraria', 'Campo', 'Valor', 'Estado', 'Comentarios'];
    public $timestamps = false;
}
