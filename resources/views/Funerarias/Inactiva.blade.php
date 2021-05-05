@extends('layouts.app')

@section('content')
<style type="text/css">
    .dropzone {
        border: 2px dashed #999999;
        border-radius: 10px;
    }

    .dropzone .dz-default.dz-message {
        height: 171px;
        background-size: 132px 132px;
        margin-top: -101.5px;
        background-position-x: center;

    }

    .dropzone .dz-default.dz-message span {
        display: block;
        margin-top: 145px;
        font-size: 20px;
        text-align: center;
    }

    li {
        cursor: pointer;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
    @if($LicenciaAmbiental == 'Pendiente' || $LicenciaAmbiental == 'Aprobado')
    <li class="nav-item">
        <a class="nav-link disabled" id="licenciaAmbiental-tab" data-toggle="tab" href="#licenciaAmbiental" role="tab" aria-controls="licenciaAmbiental" aria-selected="true">Licencia ambiental</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link active" id="licenciaAmbiental-tab" data-toggle="tab" href="#licenciaAmbiental" role="tab" aria-controls="licenciaAmbiental" aria-selected="true">Licencia ambiental</a>
    </li>
    @endif
  @if($InfoGeneral == 'Pendiente' || $InfoGeneral == 'Aprobado') 
  <li class="nav-item">
    <a class="nav-link disabled" id="infoGeneral-tab" data-toggle="tab" href="#infoGeneral" role="tab" aria-controls="infoGeneral" aria-selected="false">Información general</a>
  </li>
  @else
  <li class="nav-item">
    <a class="nav-link " id="infoGeneral-tab" data-toggle="tab" href="#infoGeneral" role="tab" aria-controls="infoGeneral" aria-selected="false">Información general</a>
  </li>
  @endif
  @if($Documentacion == 'Pendiente' || $Documentacion == 'Aprobado' || !isset($Documentacion)) 
  <li class="nav-item">
    <a class="nav-link disabled" id="documentacion-tab" data-toggle="tab" href="#documentacion" role="tab" aria-controls="documentacion" aria-selected="false">Documentacion</a>
  </li>
  @else
  <li class="nav-item">
    <a class="nav-link" id="documentacion-tab" data-toggle="tab" href="#documentacion" role="tab" aria-controls="documentacion" aria-selected="false">Documentacion</a>
  </li>
  @endif  
  @if(isset($Convenio))
    @if($Convenio == 'Pendiente' || $Convenio == 'Aprobado')
    <li class="nav-item">
        <a class="nav-link disabled" id="convenio-tab" data-toggle="tab" href="#convenio" role="tab" aria-controls="convenio" aria-selected="false">Convenio</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link" id="convenio-tab" data-toggle="tab" href="#convenio" role="tab" aria-controls="convenio" aria-selected="false">Convenio</a>
    </li>
    @endif
  @else
  <li class="nav-item">
    <a class="nav-link disabled" id="convenio-tab" data-toggle="tab" href="#convenio" role="tab" aria-controls="convenio" aria-selected="false">Convenio</a>
  </li>
  @endif
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="licenciaAmbiental" role="tabpanel" aria-labelledby="licenciaAmbiental-tab">
    <div class="card text-center">
        @if($LicenciaAmbiental == 'Pendiente')
        <br>
        <br>
        <h3>Licencia ambiental pendiente de verificar</h3>
        <br>
        @elseif($LicenciaAmbiental == 'Aprobado')
        <h3>Aprobado, proceda al siguiente paso</h3>
        @endif
        @if($LicenciaAmbiental == 'Pendiente' || $LicenciaAmbiental == 'Aprobado')
        <div class="card-body align-items-center" style="display: none;">
        @else
        <div class="card-body align-items-center">
        @endif
            <div class="form-group">
                <form action="/Funeraria/info/guardarMedia/licenciaAmbiental" enctype="multipart/form-data"
                    class="dropzone" id="fileupload" method="POST">
                    @csrf
                    <div class="fallback">
                        <input name="file" type="files" multiple
                            accept="image/jpeg, image/png, image/jpg" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="tab-pane fade" id="infoGeneral" role="tabpanel" aria-labelledby="infoGeneral-tab">
        <div class="card">
            <div class="card-body align-items-center">
                <form action="/Funeraria/info/actualizarInfo" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipo_funneraria">Tipo de funeraria</label>
                            <select name="tipo_funeraria" class="form-control">
                                <option>--Seleccione--</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="NIT">NIT</label>
                            <input type="text" name="nit" id="NIT"
                                class="form-control" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono"
                                class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" id="direccion"
                                class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="depto">Departamento</label>
                            <select name="departamento" id="departamento" class="form-control" required
                                    onclick="makeSubmenu(this.value)">
                                    <option disabled>- Seleccione una opción -</option>
                                    <option value="Alta Verapaz">Alta Verapaz</option>
                                    <option value="Baja Verapaz">Baja Verapaz</option>
                                    <option value="Chimaltenango">Chimaltenango</option>
                                    <option value="Chiquimula">Chiquimula</option>
                                    <option value="Petén">Petén</option>
                                    <option value="El Progreso">El Progreso</option>
                                    <option value="Quiché">Quiché</option>
                                    <option value="Escuintla">Escuintla</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Huehuetenango">Huehuetenango</option>
                                    <option value="Izabal">Izabal</option>
                                    <option value="Jalapa">Jalapa</option>
                                    <option value="Jutiapa">Jutiapa</option>
                                    <option value="Quetzaltenango">Quetzaltenango</option>
                                    <option value="Retalhuleu">Retalhuleu</option>
                                    <option value="Sacatepéquez">Sacatepéquez</option>
                                    <option value="San Marcos">San Marcos</option>
                                    <option value="Santa Rosa">Santa Rosa</option>
                                    <option value="Sololá">Sololá</option>
                                    <option value="Suchitepéquez">Suchitepéquez</option>
                                    <option value="Totonicapán">Totonicapán</option>
                                    <option value="Zacapa">Zacapa</option>
                                </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="municipio">Municipio</label>
                            <select name="municipio" id="municipio" class="form-control" required>
                                <option>Seleccione primero el departamento</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre_contacto">Nombre contacto principal</label>
                            <input type="text" name="nombre_contacto" id="nombre_contacto"
                                class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="numero_contacto">Número contacto principal</label>
                            <input type="text" name="numero_contacto" id="numero_contacto"
                                class="form-control" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
  <div class="tab-pane fade" id="documentacion" role="tabpanel" aria-labelledby="documentacion-tab">
        <div class="card">
            <div class="card-body align-items-center">
                
                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'patenteComercio')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Patente de comercio</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'patenteComercio')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/patenteComercio" enctype="multipart/form-data"
                        class="dropzone" id="patenteComercio" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>

                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'rtu')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>RTU Actualizado</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'rtu')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/rtu" enctype="multipart/form-data"
                        class="dropzone" id="rtu" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>

                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'dpi')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            < class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Copia de DPI</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'dpi')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/dpi" enctype="multipart/form-data"
                        class="dropzone" id="dpi" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                
                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'licenciaSanitaria')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Licencia Sanitaria</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'licenciaSanitaria')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/licenciaSanitaria" enctype="multipart/form-data"
                        class="dropzone" id="licenciaSanitaria" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>
                
                </div>
                @if($Tipo_Funeraria == 'B' || $Tipo_Funeraria == 'A')
                
                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'certManipulacionCuerpos')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Certificado de manipulación de cuerpos</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'certManipulacionCuerpos')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/certManipulacionCuerpos" enctype="multipart/form-data"
                        class="dropzone" id="certManipulacionCuerpos" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>
                @endif
                @if($Tipo_Funeraria == 'A')
                
                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'licManipulacionCuerpos')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Licencia de manipulación de cuerpos</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'licManipulacionCuerpos')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/licManipulacionCuerpos" enctype="multipart/form-data"
                        class="dropzone" id="licManipulacionCuerpos" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>
                @endif
                @if($Tipo_Funeraria == 'B' || $Tipo_Funeraria == 'A')
                
                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'manipulacionAlimentos')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Licencia de manipulación de alimentos o carta de restaurante que apoye</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'manipulacionAlimentos')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/manipulacionAlimentos" enctype="multipart/form-data"
                        class="dropzone" id="manipulacionAlimentos" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>
                @endif
                @if($Tipo_Funeraria == 'A')
                
                @foreach($AllDocuments as $documents)
                    @if($documents->Documento == 'bioinfecciosos')
                        @if($documents->Estatus == 'Aprobado' || is_null($documents->Estatus))
                            <div class="form-group" style="display: none;">
                        @else
                            <div class="form-group"> 
                        @endif
                    @endif
                @endforeach
                    <h3>Certificado de desechos bioinfecciosos</h3>
                    @foreach($AllDocuments as $documents)
                        @if($documents->Documento == 'bioinfecciosos')
                            @if($documents->Estatus == 'Denegado')
                                <p class="text-danger">Su documento ha sido rechazado, rectifique a continuación.</p>
                                <b>Motivo: </b> <p class="text-danger">{{$documents->Comentarios}}</p>
                            @endif
                        @endif
                    @endforeach
                    <form action="/Funeraria/info/guardarMedia/bioinfecciosos" enctype="multipart/form-data"
                        class="dropzone" id="bioinfecciosos" method="POST">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="files" multiple
                                accept="image/jpeg, image/png, image/jpg" />
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
  </div>
  <div class="tab-pane fade" id="convenio" role="tabpanel" aria-labelledby="convenio-tab">
    <div class="card">
        <div class="card-body align-items-center">
            <a href="/convenio"><h1>Descargar convenio</h1></a>
        </div>
    </div>
    </div>
</div>


            <!--<div class="card">

                <div class="card-body align-items-center d-flex justify-content-center">
                    
                <div class="row">
                    <div class="col">
                        <h1><b>Funeraria Inactiva</b></h1>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                    @if(isset($Detalle->Campos))

                    @if(json_decode($Detalle->Campos)[0]->campo == 'InfoGeneral' && json_decode($Detalle->Campos)[0]->result == 'No')
                    Subir
                    <br>
                    @elseif(json_decode($Detalle->Campos)[0]->campo == 'InfoGeneral' && json_decode($Detalle->Campos)[0]->result == 'Pendiente')
                    Pendiente de revisión
                    <br>
                    @else
                    Subido
                    <br>
                    @endif

                    @if(json_decode($Detalle->Campos)[1]->campo == 'Documentos' && json_decode($Detalle->Campos)[1]->result == 'No')
                    Subir
                    <br>
                    @elseif(json_decode($Detalle->Campos)[1]->campo == 'Documentos' && json_decode($Detalle->Campos)[1]->result == 'Pendiente')
                    Pendiente de revisión
                    <br>
                    @else
                    Subido
                    <br>
                    @endif

                    @if(json_decode($Detalle->Campos)[2]->campo == 'Contrato' && json_decode($Detalle->Campos)[2]->result == 'No')
                    Subir
                    <br>
                    @elseif(json_decode($Detalle->Campos)[2]->campo == 'Contrato' && json_decode($Detalle->Campos)[2]->result == 'Pendiente')
                    Pendiente de revisión
                    <br>
                    @else
                    Subido
                    <br>
                    @endif

                @endif
                    </div>
                </div>
                
                </div>
            </div>-->
        </div>
    </div>
</div>

@if($Activa == 'Si')
    <script>
        $(document).ready(function(){
            window.location.href = '/Funerarias/Casos/ver';
        });
    </script>
@endif
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
    Dropzone.options.fileupload = {

    }

    if (typeof Dropzone != 'undefined') {
        Dropzone.autoDiscover = false;
    }

    ;
    (function ($, window, undefined) {
        "use strict";

        $(document).ready(function () {
            console.log('done');
            // Dropzone Example
            if (typeof Dropzone != 'undefined') {
                if ($("#fileupload").length) {
                    var dz = new Dropzone("#fileupload"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#patenteComercio"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#rtu"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#licenciaSanitaria"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#dpi"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#certManipulacionCuerpos"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#licManipulacionCuerpos"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#manipulacionAlimentos"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var dz = new Dropzone("#bioinfecciosos"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    var $f = $(
                        '<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>'
                    );
                    dz.on("success", function (file, responseText) {

                            var _$f = $f.clone();

                            _$f.addClass('success');

                            _$f.find('.name').html(file.name);
                            if (file.size < 1024) {
                                _$f.find('.size').html(parseInt(file.size) + ' KB');
                            } else {
                                _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
                            }
                            _$f.find('.type').html(file.type);
                            _$f.find('.status').html('Uploaded <i class="entypo-check"></i>');

                            dze_info.find('tbody').append(_$f);

                            status.uploaded++;

                            dze_info.find('tfoot td').html('<span class="label label-success">' + status
                                .uploaded + ' uploaded</span> <span class="label label-danger">' +
                                status.errors + ' not uploaded</span>');

                            toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {
                                timeOut: 50000000
                            });

                        })
                        .on('error', function (file) {
                            var _$f = $f.clone();

                            dze_info.removeClass('hidden');

                            _$f.addClass('danger');

                            _$f.find('.name').html(file.name);
                            _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
                            _$f.find('.type').html(file.type);
                            _$f.find('.status').html('Uploaded <i class="entypo-cancel"></i>');

                            dze_info.find('tbody').append(_$f);

                            status.errors++;

                            dze_info.find('tfoot td').html('<span class="label label-success">' + status
                                .uploaded + ' uploaded</span> <span class="label label-danger">' +
                                status.errors + ' not uploaded</span>');

                            toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {
                                timeOut: 5000
                            });
                        });
                }
            }
        });
    })(jQuery, window);

    function makeSubmenu(value) {
        var municipio = {!! $Json !!};

        if (value.length == 0) {
            $('#municipio').html = "<option></option>";
        } else {
            var munOptions = "";
            for (munId in municipio[value]) {
                munOptions += "<option value='" + municipio[value][munId] + "'>" + municipio[value][munId] +
                "</option>";
            }
            document.getElementById("municipio").innerHTML = munOptions;
        }
    }

</script>
@endsection
