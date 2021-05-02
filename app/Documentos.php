<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table = 'documentacion';
    public $fillable = ['Documento', 'Descripcion'];
    public $timestamps = false;
}
