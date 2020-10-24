@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/basic.css" rel="stylesheet" type="text/css" />
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
    <a href="/Funerarias/Casos/ver" class="btn btn-link mb-2">< Atrás</a>
    <div class="row ">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Visualizar caso</div>
                <div class="card-body align-items-center justify-content-center">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Ingrese nombre del estudiante" value="{{$Caso->Nombre}}" readonly>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="causa">Causa</label>
                            <input type="text" name="causa" id="causa" class="form-control" value="{{$Caso->Causa}}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label for="departamento">Departamento</label>
                            <input type="text" name="departamento" id="departamento" class="form-control"
                                value="{{$Caso->Departamento}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="municipio">Municipio</label>
                            <input type="text" name="municipio" id="municipio" class="form-control"
                                value="{{$Caso->Municipio}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                value="{{$Caso->Direccion}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lugar">Lugar de los hechos</label>
                        <input type="text" name="lugar" id="lugar" class="form-control" value="{{$Caso->Lugar}}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="NombreReporta">Nombre de quien reporta</label>
                        <input type="text" name="NombreReporta" id="NombreReporta" class="form-control"
                            value="{{$Caso->NombreReporta}}" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="RelacionReporta">Relaci&oacute;n</label>
                            <input type="text" name="RelacionReporta" id="RelacionReporta" class="form-control"
                                value="{{$Caso->RelacionReporta}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="TelReporta">Tel&eacute;fono</label>
                            <input type="text" name="TelReporta" id="TelReporta" class="form-control"
                                value="{{$Caso->TelReporta}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="padre">Padre</label>
                            <input type="text" name="padre" id="padre" class="form-control" value="{{$Caso->Padre}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="TelPadre">Tel. Padre</label>
                            <input type="text" name="TelPadre" id="TelPadre" class="form-control"
                                value="{{$Caso->TelPadre}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="madre">Madre</label>
                            <input type="text" name="madre" id="madre" class="form-control" value="{{$Caso->Madre}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="TelMadre">Tel. Madre</label>
                            <input type="text" name="TelMadre" id="TelMadre" class="form-control"
                                value="{{$Caso->TelMadre}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Tutor">Tutor</label>
                        <input type="text" name="Tutor" id="Tutor" class="form-control" value="{{$Caso->Tutor}}"
                            readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="TelTutor">Tel&eacute;fono Tutor</label>
                            <input type="text" name="TelTutor" id="TelTutor" class="form-control"
                                value="{{$Caso->TelTutor}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="DPITutor">DPI Tutor</label>
                            <input type="text" name="DPITutor" id="DPITutor" class="form-control"
                                value="{{$Caso->DPITutor}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ParentescoTutor">Parentesco Tutor</label>
                            <input type="text" name="ParentescoTutor" id="ParentescoTutor" class="form-control"
                                value="{{$Caso->ParentescoTutor}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="EmailTutor">Email Tutor</label>
                            <input type="text" name="EmailTutor" id="EmailTutor" class="form-control"
                                value="{{$Caso->EmailTutor}}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ComentarioTutor">Comentarios</label>
                            <textarea id="ComentarioTutor" name="ComentarioTutor" class="form-control" cols="80"
                                readonly>{{$Caso->ComentarioTutor}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idioma">Idioma</label>
                            <input type="text" name="Idioma" id="Idioma" class="form-control" value="{{$Caso->Idioma}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idioma">M&eacute;dico que atendi&oacute;</label>
                            <input type="text" name="Medico" id="Medico" class="form-control" value="{{$Caso->Medico}}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fechaNacimiento">Fecha</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fecha"
                                placeholder="00/00/0000" value="{{$Caso->Fecha}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pohoralhoraiza">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"
                                value="{{date('G:i', strtotime($Caso->Hora))}}" readonly><span id="errmsg"></span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Modificar Costo Base</div>
                <div class="card-body">
                @php
                $tiene_solicitud = 0
                @endphp
                @foreach($Solicitudes As $Solicitud)
                @if($Solicitud->estatus == 'Pendiente')
                @php
                $tiene_solicitud = 1
                @endphp
                @endif
                @endforeach
                <form action="/Funerarias/Casos/{{$Caso->id}}/actualizarCosto" method="post">
                    @csrf
                    <div class="container">
                        @if($tiene_solicitud == 1)
                        <div class="row">
                            <div class="col-12 text-center">
                                <b>Actualmente tiene una solicitud pendiente de actualización de costo.</b>
                            </div>
                        </div>
                        @endif
                        <div class="form-row m-0">
                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                <label for="costoServicio">Costo</label>
                                <input type="text" class="form-control" value="{{$Caso->Costo}}" name="Costo"
                                    {{$tiene_solicitud == 1 ? "readonly" : ""}}>
                            </div>

                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                <label for="Pendiente">Pendiente</label>
                                <input type="text" class="form-control" value="{{$Caso->Costo - $Caso->Pagado}}"
                                    readonly>
                            </div>
                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                <label for="pagado">Pagado</label>
                                <input type="text" class="form-control" value="{{$Caso->Pagado}}" readonly>
                            </div>
                        </div>
                        <div class="form-row m-0">
                            <div class="form-group col-md-12 p-2 m-0 d-flex flex-column justify-content-end">
                                <label for="descripcionCosto">Descripci&oacute;n</label>
                                <textarea name="Descripcion" class="form-control"
                                    {{$tiene_solicitud == 1 ? "readonly" : ""}}></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block"
                                    {{$tiene_solicitud == 1 ? "disabled" : ""}}>Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Archivos</div>
                    <div class="card-body">
                    <ul class="list-group">
                        @foreach($Archivos as $archivo)
                        <li class="list-group-item"><b><a target="popup"
                                    onclick="window.open('/images/caso{{$Caso->id}}-{{$archivo}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$archivo}}</a></b>
                        </li>
                        @endforeach
                    </ul>
                    <hr>
                    <div class="form-group">
                        <form action="/Funeraria/Caso/{{$Caso->id}}/guardarMedia" enctype="multipart/form-data"
                            class="dropzone" id="fileupload" method="POST">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
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
            // Dropzone Example
            if (typeof Dropzone != 'undefined') {
                if ($("#fileupload").length) {
                    var dz = new Dropzone("#fileupload"),
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

</script>
@endsection
