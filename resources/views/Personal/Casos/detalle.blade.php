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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles caso</div>

                <div class="card-body align-items-center justify-content-center">
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#funerariaModal">Asignar Funeraria</button>
                            @if($Caso->Solicitud != 'Pendiente')
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#solicitudModal">Solicitudes</button>
                            @else
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#solicitudModal">Solicitud Nueva</button>
                            @endif
                            @if($Caso->Estatus == 'Cerrado')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cerrarModal"
                                disabled>Cerrar caso</button>
                            @else
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#cerrarModal">Cerrar caso</button>
                            @endif
                            @if($Caso->Reportar == 'Si')
                            <input type="checkbox" checked data-toggle="toggle" data-on="Reportar"
                                data-off="No Reportar" data-onstyle="success" data-offstyle="danger"
                                onchange="reportar('No')">
                            @else
                            <input type="checkbox" data-toggle="toggle" data-on="Reportar" data-off="No Reportar"
                                data-onstyle="success" data-offstyle="danger" onchange="reportar('Si')">
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-row m-0">
                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="costoServicio">Costo</label>
                            <input type="text" class="form-control" value="{{$Caso->Costo}}" readonly>
                        </div>

                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="Pendiente">Pendiente</label>
                            <input type="text" class="form-control" value="{{$Caso->Costo - $Caso->Pagado}}" readonly>
                        </div>
                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="pagado">Pagado</label>
                            <input type="text" class="form-control" value="{{$Caso->Pagado}}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="codEstudiante">Código de Estudiante</label>
                            <input type="text" class="form-control" id="codEstudiante" name="codEstudiante"
                                placeholder="0000000" value="{{$Caso->Codigo}}" readonly><span id="errmsg"></span>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Ingrese nombre del estudiante" value="{{$Caso->Nombre}}" readonly>
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
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="causa">Causa</label>
                            <input type="text" name="causa" id="causa" class="form-control" value="{{$Caso->Causa}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="idioma">Idioma</label>
                            <input type="text" name="Idioma" id="Idioma" class="form-control" value="{{$Caso->Idioma}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="idioma">M&eacute;dico que atendi&oacute;</label>
                            <input type="text" name="Medico" id="Medico" class="form-control" value="{{$Caso->Medico}}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                value="{{$Caso->Direccion}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="departamento">Departamento</label>
                            <input type="text" name="departamento" id="departamento" class="form-control"
                                value="{{$Caso->Departamento}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="municipio">Municipio</label>
                            <input type="text" name="municipio" id="municipio" class="form-control"
                                value="{{$Caso->Municipio}}" readonly>
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
                    <hr>
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
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ComentarioTutor">Comentarios</label>
                            <textarea id="ComentarioTutor" name="ComentarioTutor" class="form-control" cols="80"
                                readonly>{{$Caso->ComentarioTutor}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="lugar">Lugar de los hechos</label>
                        <input type="text" name="lugar" id="lugar" class="form-control" value="{{$Caso->Lugar}}"
                            readonly>
                    </div>
                    <hr>
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
                    <hr>
                    <h1>Archivos</h1>
                    <ul class="list-group">
                        @foreach($Archivos as $archivo)
                        <li class="list-group-item"><b><a target="popup"
                                    onclick="window.open('/images/caso{{$Caso->id}}-{{$archivo}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$archivo}}</a></b>
                        </li>
                        @endforeach
                    </ul>
                    <hr>
                    <div class="form-group">
                        <form action="/Caso/{{$Caso->id}}/guardarMedia" enctype="multipart/form-data" class="dropzone"
                            id="fileupload" method="POST">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </form>
                    </div>
                    <br>
                    <h1>Historial de Pagos</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Pago</th>
                                        <th scope="col">Factura</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Pagos as $Pago)
                                    <tr>
                                        <td>{{$Pago->id}}</td>
                                        <td>{{$Pago->factura}}</td>
                                        <td>{{$Pago->monto}}</td>
                                        <td>{{date("d-m-Y", strtotime("$Pago->fecha"))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <h1>Registrar Pagos</h1>
                    <form action="/Casos/{{$Caso->id}}/actualizarPago" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Factura</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaPagos">
                                        <tr class="fila1">
                                            <td><input name="factura1" type="text" class="form-control"></td>
                                            <td><input name="monto1" type="text" class="form-control"></td>
                                            <td><input name="fecha1" type="date" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="filas" id="filas" value="1">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-success" onClick="agregarFila();">Agregar</button>
                                <button type="button" class="btn btn-danger" onClick="quitarFila();">Quitar</button>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning pull-right">Guardar</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="funerariaModal" tabindex="-1" role="dialog" aria-labelledby="funerariaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="funerariaModalLabel">Funerarias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-funerarias">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Funerarias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-detalle">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cerrarModal" tabindex="-1" role="dialog" aria-labelledby="cerrarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cerrarModalLabel">Cerrar caso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1><b>¿Est&aacute; seguro que desea cerrar el caso?</b></h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="cerrarCaso({{$Caso->id}})">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="solicitudModal" tabindex="-1" role="dialog" aria-labelledby="solicitudModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitudModalLabel">Funerarias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($Solicitudes As $solicitud)
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="header-{{$solicitud->id}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#acc-cont-{{$solicitud->id}}" aria-expanded="true"
                                    aria-controls="acc-cont-{{$solicitud->id}}">
                                    Solicitud #<b>{{$solicitud->id}}</b> -
                                    @if($solicitud->estatus == 'Aprobar')
                                    <span class="text-success">Aprobada</span>
                                    @elseif($solicitud->estatus == 'Declinar')
                                    <span class="text-danger">Declinada</span>
                                    @else
                                    <span class="text-warning">Pendiente</span>
                                    @endif
                                </button>
                            </h5>
                        </div>

                        <div id="acc-cont-{{$solicitud->id}}" class="collapse"
                            aria-labelledby="header-{{$solicitud->id}}" data-parent="#accordion">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Nuevo costo: </b>{{$solicitud->costo}}
                                            <br>
                                            <p><b>Descripci&oacute;n de solicitud:</b></p>
                                            <span>{{$solicitud->descripcion}}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    @if($solicitud->estatus == 'Pendiente')
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-danger btn-block"
                                                onclick="actualizarSolicitud({{$solicitud->id}}, 'Declinar')">Declinar</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-success btn-block"
                                                onclick="actualizarSolicitud({{$solicitud->id}}, 'Aprobar')">Aceptar</button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

                            dze_info.find('tfoot td').html('<span class="label label-success">' +
                                status
                                .uploaded +
                                ' uploaded</span> <span class="label label-danger">' +
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

                            dze_info.find('tfoot td').html('<span class="label label-success">' +
                                status
                                .uploaded +
                                ' uploaded</span> <span class="label label-danger">' +
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
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: "https://umbd.excess.software/api/getFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                for (var i = 0; i < len; i++) {
                    if (response[i].departamento == "{{$Caso->Departamento}}") {
                        html += '<h3><b>Recomendada</b></h3>\
                        <table class="table">\
                            <thead class="thead-dark">\
                                <tr>\
                                    <th scope="col">Funeraria</th>\
                                    <th scope="col">Departamento</th>\
                                    <th scope="col">Tel.</th>\
                                    <th scope="col">Acciones</th>\
                                </tr>\
                            </thead>\
                            <tbody>\
                                <tr>\
                                    <td>' + response[i].funeraria + '</td>\
                                    <td>' + response[i].departamento + '</td>\
                                    <td>' + response[i].tel_contacto + '</td>\
                                    <td><button class="btn btn-primary" id="idFuneraria" onclick="detalleFuneraria(' +
                            response[i].id +
                            ')"><i class="fa fa-eye"></i></button> <button disabled class="btn btn-warning asignar" onclick="preAsignarFuneraria({{$Caso->id}},' +
                            response[i].id + ')">Asignar</button></td>\
                                </tr>\
                            </tbody>\
                        </table><br>';
                    }
                }
                html += '<div class="row">\
                            <div class="col text-center">\
                            <h4><b>Seleccione los medios por los cuales desea notificar a la funeraria.</b></h4>\
                            </div>\
                        </div>\
                        <div class="row">\
                            <div class="col text-center">\
                                <div class="form-check form-check-inline">\
                                    <input class="form-check-input" type="checkbox" id="Correo" value="Si" style="width:20px; height:20px;" onchange="habilitarAsignar();">\
                                    <label class="form-check-label" for="Correo"><h4>Correo</h4></label>\
                                </div>\
                                <div class="form-check form-check-inline">\
                                    <input class="form-check-input" type="checkbox" id="WhatsApp" value="Si" style="width:20px; height:20px;" onchange="habilitarAsignar();">\
                                    <label class="form-check-label" for="WhatsApp"><h4>WhatsApp</h4></label>\
                                </div>\
                            </div>\
                        </div>';
                html += '<h3><b>Funerarias</b></h3>\
                        <table class="table">\
                            <thead class="thead-dark">\
                                <tr>\
                                    <th scope="col">Funeraria</th>\
                                    <th scope="col">Departamento</th>\
                                    <th scope="col">Tel.</th>\
                                    <th scope="col">Acciones</th>\
                                </tr>\
                            </thead>\
                            <tbody>';
                for (var j = 0; j < len; j++) {
                    if (response[j].departamento != "{{$Caso->Departamento}}") {
                        html += '<tr>\
                                    <td>' + response[j].funeraria + '</td>\
                                    <td>' + response[j].departamento + '</td>\
                                    <td>' + response[j].tel_contacto + '</td>\
                                    <td><button class="btn btn-primary" id="idFuneraria" onclick="detalleFuneraria(' +
                            response[j].id +
                            ')"><i class="fa fa-eye"></i></button> <button disabled class="btn btn-warning asignar" onclick="asignarFuneraria({{$Caso->id}},' +
                            response[j].id + ')">Asignar</button></td>\
                                </tr>';
                    }
                }
                html += '</tbody>\
                        </table><br>';
                $('#modal-funerarias').html(html);
            }
        });
    });

    function detalleFuneraria(id) {
        $.ajax({
            url: "https://umbd.excess.software/api/getFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                var costo_servicio = 0;
                for (let i = 0; i < len; i++) {
                    if (response[i].id == id) {
                        if (response[i].id == '6') {
                            costo_servicio = 1500;
                        } else if (response[i].id == '7') {
                            costo_servicio = 1300;
                        } else {
                            costo_servicio = 1000;
                        }

                        html = '<p><b>Funeraria: ' + response[i].funeraria + '</b></p>\
                        <p><b>Direcci&oacute;n: ' + response[i].direccion + '</b></p>\
                        <p><b>Departamento: ' + response[i].departamento + '</b></p>\
                        <p><b>Tel. Contacto: ' + response[i].tel_contacto + '</b></p>\
                        <p><b>Tel. Coordinador: ' + response[i].tel_coordinador + '</b></p>\
                        <p><b>Costo del servicio: ' + costo_servicio + '</b></p>';
                    }
                }
                $('#modal-detalle').html(html);
                $('#detalleModal').modal('show');
            }
        });
    }

    function habilitarAsignar() {
        if ($('#Correo').is(':checked') || $('#WhatsApp').is(':checked')) {
            $(".asignar").attr("disabled", false);
        } else {
            $(".asignar").attr("disabled", true);
        }
    }

    function preAsignarFuneraria(caso, id) {
        var correo = 'No';
        var whatsapp = 'No';
        var valor = 'No';
        if ($('#Correo').is(':checked')) {
            correo = 'Si';
        }
        if ($('#WhatsApp').is(':checked')) {
            whatsapp = 'Si';
        }
        asignarFuneraria(caso, id, correo, whatsapp);
    }

    function asignarFuneraria(caso, id, correo, wp) {
        $.ajax({
            url: "/Casos/" + caso + "/asignarFuneraria/" + id + "/" + correo + "/" + wp,
            type: 'get',
            success: function (response) {
                window.location.href = '/Casos/ver';
            }
        });
    }

    function cerrarCaso(caso) {
        $.ajax({
            url: "/Casos/cerrarCaso/" + caso,
            type: 'get',
            success: function (response) {
                window.location.href = '/Casos/ver';
            }
        });
    }

    function reportar(indicador) {
        $.ajax({
            url: "/Casos/Reportar/{{$Caso->id}}/" + indicador,
            type: 'get',
            sucess: function (response) {
                window.location.href = '/Casos/{{$Caso->id}}/ver';
            }
        });
        setTimeout(function () {
            location.reload();
        }, 1000);
    }

    function agregarFila() {
        var fila = $('#filas').val();
        var nuevafila = parseInt(fila) + 1;
        $('#filas').val(nuevafila);
        var html = '<tr class="fila' + nuevafila + '">\
            <td><input name="factura' + nuevafila + '" type="text" class="form-control"></td>\
            <td><input name="monto' + nuevafila + '" type="text" class="form-control"></td>\
            <td><input name="fecha' + nuevafila + '" type="date" class="form-control"></td>\
        </tr>';
        $('#tablaPagos').append(html);
    }

    function quitarFila() {
        var fila = $('#filas').val();
        var nuevafila = parseInt(fila) - 1;
        $('#filas').val(nuevafila);
        $('#fila' + fila).remove();
    }

    function actualizarSolicitud(solicitud, opcion) {
        $.ajax({
            url: "/Casos/Solicitudes/{{$Caso->id}}/" + solicitud + "/" + opcion,
            type: 'get',
            sucess: function (response) {
                window.location.href = '/Casos/{{$Caso->id}}/ver';
            }
        })
        setTimeout(function () {
            location.reload();
        }, 1000);
    }

</script>
@endsection
