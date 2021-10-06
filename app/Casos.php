<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    protected $table = 'casos';
    public $fillable = ['Codigo', 'Edad', 'Agente', 'Nombre', 'Aseguradora', 'Nombre_Aseguradora', 
    'Fecha', 'Hora', 'Causa', 'Causa_Desc', 'Causa_Especifica', 'Direccion', 'Departamento', 
    'Municipio', 'Padre', 'TelPadre', 'Madre', 'TelMadre', 'NombreReporta', 'RelacionReporta', 
    'TelReporta', 'Lugar', 'Funeraria', 'Funeraria_Nombre', 'Estatus', 'Reportar', 'ServicioFunerarioContratado', 
    'Costo', 'Costo_Retencion', 'Moneda', 'Pagado', 'Solicitud', 'Idioma', 'Medico', 'Tutor', 'TelTutor', 'DPITutor', 'ParentescoTutor', 
    'EmailTutor', 'Comentario', 'Evaluacion', 'Certificado', 'Poliza', 'TipoAsegurado',
    'Correlativo', 'Correlativo_Completo', 'Mes', 'Anio', 'Aseguradora_Nombre', 'Campania', 'Mail_Enviado', 
    'Funeraria_Externa_Nombre', 'Funeraria_Externa_NIT', 'Funeraria_Externa_Banco', 
    'Funeraria_Externa_NoCuenta', 'Funeraria_Externa_Comprobante', 'token', 'Factura', 'Estatus_CHN', 'Observaciones_CHN',
    'ISR', 'Comprobante_ISR'
];
}
