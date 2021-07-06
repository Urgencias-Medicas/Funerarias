<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentosCHN extends Model
{
    protected $table = 'documentos_caso_chn';
    public $fillable = ['caso', 'ruta', 'estatus'];
    public $timestamps = false;
}
