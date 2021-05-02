<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentosFuneraria extends Model
{
    protected $table = 'documentos_funerarias';
    public $fillable = ['Funeraria', 'Documento', 'Ruta', 'Estatus', 'Comentarios'];
    public $timestamps = false;
}
