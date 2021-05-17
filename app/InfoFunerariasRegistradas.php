<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoFunerariasRegistradas extends Model
{
    protected $table = 'info_funerarias_registradas';
    public $fillable = ['funeraria','direccion','departamento','municipio','tel_contacto','tel_coordinador','convenio','estado'];
    public $timestamps = false;
}
