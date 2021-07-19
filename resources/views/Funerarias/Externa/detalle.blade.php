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
@if(session('alerta'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('alerta')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container"> 
    
    <div class="row">
        <div class="col">
        <button type="submit" class="btn btn-success float-right mr-2" id="btnGuardar" form="modificarForm">
            Guardar
            cambios del caso</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Datos de la funeraria</div>
                <div class="card-body align-items-center justify-content-center">
                    <form action="/Externa/Casos/{{$Caso->id}}/modificarFuneraria" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="Nombre">Nombre</label>
                                <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder=""
                                    value="{{$Caso->Funeraria_Externa_Nombre}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="NIT">NIT</label>
                                <input type="text" class="form-control" id="NIT" name="NIT"
                                    placeholder="" value="{{$Caso->Funeraria_Externa_NIT}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"><span id="errmsg"></span>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Banco">Banco</label>
                                <input type="text" class="form-control" id="Banco" name="Banco" value="{{$Caso->Funeraria_Externa_Banco}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Cuenta">Cuenta</label>
                                <input type="text" class="form-control" id="Cuenta" name="Cuenta" value="{{$Caso->Funeraria_Externa_NoCuenta}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                <small>El nombre de la cuenta debe coincidir con el de la factura</small>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Cuenta">Documento</label>
                                <input type="file" class="form-control" name="Comprobante" required>
                                <small>Debe subir un docto que verifique su No. de cuenta</small>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">&nbsp;</label>
                                <button type="submit" class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Visualizar caso - <b>#{{$Caso->id}}</b></div>
                        <div class="card-body align-items-center justify-content-center">
                            <form action="/Externa/Casos/{{$Caso->id}}/modificar" id="modificarForm" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="Agente">Agente</label>
                                        <input type="text" class="form-control" id="Agente" name="Agente" placeholder=""
                                            value="{{$Caso->Agente}}" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="codEstudiante">Codigo</label>
                                        <input type="text" class="form-control" id="codEstudiante" name="codEstudiante"
                                            placeholder="" value="{{$Caso->Codigo}}" readonly><span id="errmsg"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Ingrese el nombre" value="{{$Caso->Nombre}}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="edad">Edad</label>
                                        <input type="text" name="edad" id="edad" class="form-control"
                                            value="{{$Caso->Edad}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Aseguradora">Cod. Aseguradora</label>
                                        <input type="text" name="aseguradora" id="Aseguradora" class="form-control"
                                            value="{{$Caso->Aseguradora}}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="causa">Causa</label>
                                        <select name="causa" id="causa" class="form-control">
                                            <option value="Accidente">Accidente</option>
                                            <option value="Suicidio">Suicidio</option>
                                            <option value="Asesinato">Asesinato</option>
                                            <option value="Causas Naturales">Causas Naturales</option>
                                            <option value="Enfermedad Comun">Enfermedad Com&uacute;n</option>
                                        </select>
                                    </div>
                                </div>


                                <input type="hidden" name="causa_id" id="causa_id">
                                <div class="form-row">
                                    <div class="form-group col-md-12" id="descripcion_causa" style="display: none;">
                                        <label for="descripcion_causa">Causa de muerte</label>
                                        <input type="text" class="form-control" id="descripcion_causa_input"
                                            name="descripcion_causa_input">
                                    </div>
                                    <div class="form-group col-md-8" id="selectcol">

                                        <label for="descripcion_causa">Causa de muerte</label>
                                        <select name="descripcion_causa_select" id="descripcion_causa_select"
                                            class="selectpicker form-control" data-live-search="true">
                                            @foreach($Causas as $causa)
                                            @if($causa->Causa == $Caso->Causa_Desc)
                                            <option value="{{$causa->Causa}}" selected>{{$causa->Causa}}</option>
                                            @endif
                                            <option value="{{$causa->Causa}}">{{$causa->Causa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="btncol">
                                        <label for="btn-nueva">Nueva causa</label>
                                        <button type="button" class="btn btn-primary btn-block"
                                            onclick="agregarCausa();">+</button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="causa_especifica">Descripcion de causa</label>
                                        <input type="text" name="causa_especifica" id="causa_especifica"
                                            class="form-control" value="{{$Caso->Causa_Especifica}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="departamento">Departamento</label>
                                        <select name="departamento" id="departamento" class="form-control" required
                                            onclick="makeSubmenu(this.value)">
                                            <option>{{$Caso->Departamento}}</option>
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
                                            <option>{{$Caso->Municipio}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control"
                                            value="{{$Caso->Direccion}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lugar">Lugar de los hechos</label>
                                    <input type="text" name="lugar" id="lugar" class="form-control"
                                        value="{{$Caso->Lugar}}">
                                </div>
                                <div class="form-group">
                                    <label for="NombreReporta">Nombre de quien reporta</label>
                                    <input type="text" name="NombreReporta" id="NombreReporta" class="form-control"
                                        value="{{$Caso->NombreReporta}}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="RelacionReporta">Relaci&oacute;n</label>
                                        <input type="text" name="RelacionReporta" id="RelacionReporta"
                                            class="form-control" value="{{$Caso->RelacionReporta}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="TelReporta">Tel&eacute;fono</label>
                                        <input type="text" name="TelReporta" id="TelReporta" class="form-control"
                                            value="{{$Caso->TelReporta}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="padre">Padre</label>
                                        <input type="text" name="padre" id="padre" class="form-control"
                                            value="{{$Caso->Padre}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="TelPadre">Tel. Padre</label>
                                        <input type="text" name="TelPadre" id="TelPadre" class="form-control"
                                            value="{{$Caso->TelPadre}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="madre">Madre</label>
                                        <input type="text" name="madre" id="madre" class="form-control"
                                            value="{{$Caso->Madre}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="TelMadre">Tel. Madre</label>
                                        <input type="text" name="TelMadre" id="TelMadre" class="form-control"
                                            value="{{$Caso->TelMadre}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Tutor">Tutor</label>
                                    <input type="text" name="Tutor" id="Tutor" class="form-control"
                                        value="{{$Caso->Tutor}}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="TelTutor">Tel&eacute;fono Tutor</label>
                                        <input type="text" name="TelTutor" id="TelTutor" class="form-control"
                                            value="{{$Caso->TelTutor}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="DPITutor">DPI Tutor</label>
                                        <input type="text" name="DPITutor" id="DPITutor" class="form-control"
                                            value="{{$Caso->DPITutor}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ParentescoTutor">Parentesco Tutor</label>
                                        <input type="text" name="ParentescoTutor" id="ParentescoTutor"
                                            class="form-control" value="{{$Caso->ParentescoTutor}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="EmailTutor">Email Tutor</label>
                                        <input type="text" name="EmailTutor" id="EmailTutor" class="form-control"
                                            value="{{$Caso->EmailTutor}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="ComentarioTutor">Comentarios</label>
                                        <textarea id="ComentarioTutor" name="ComentarioTutor" class="form-control"
                                            cols="80">{{$Caso->Comentario}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Medico">Agente que atendi&oacute;</label>
                                        <input type="text" name="Medico" id="Medico" class="form-control"
                                            value="{{$Caso->Medico}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="idioma">Idioma</label>
                                        <input type="text" name="Idioma" id="Idioma" class="form-control"
                                            value="{{$Caso->Idioma}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fechaNacimiento">Fecha</label>
                                        <input type="date" class="form-control" id="fechaNacimiento" name="fecha"
                                            placeholder="00/00/0000" value="{{$Caso->Fecha}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pohoralhoraiza">Hora</label>
                                        <input type="time" class="form-control" id="hora" name="hora"
                                            placeholder="00:00" value="{{date('G:i', strtotime($Caso->Hora))}}"><span
                                            id="errmsg"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Modificar Costo Base</div>
                        <div class="card-body">
                            @php
                            $tiene_solicitud = 0;
                            $caso_cerrado = 0;
                            if($Caso->Estatus == 'Cerrado'){
                            $caso_cerrado = 1;
                            }
                            @endphp
                            @foreach($Solicitudes As $Solicitud)
                            @if($Solicitud->estatus == 'Pendiente')
                            @php
                            $tiene_solicitud = 1
                            @endphp
                            @endif
                            @endforeach
                            <form action="/Externa/Casos/{{$Caso->id}}/actualizarCosto" method="post">
                                @csrf
                                <div class="container">
                                    @if($tiene_solicitud == 1)
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>Actualmente tiene una solicitud pendiente de actualización de costo.</b>
                                        </div>
                                    </div>
                                    @elseif($caso_cerrado == 1)
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>Caso cerrado</b>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-row m-0">
                                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                            <label for="costoServicio">Costo</label>
                                            <input type="text" class="form-control" value="{{$Caso->Costo}}"
                                                name="Costo"
                                                {{$tiene_solicitud == 1 || $caso_cerrado == 1 ? "readonly" : ""}} oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </div>

                                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                            <label for="Pendiente">Pendiente</label>
                                            <input type="text" class="form-control"
                                                value="{{$Caso->Costo - $Caso->Pagado}}" readonly>
                                        </div>
                                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                            <label for="pagado">Pagado</label>
                                            <input type="text" class="form-control" value="{{$Caso->Pagado}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row m-0">
                                        <div
                                            class="form-group col-md-12 p-2 m-0 d-flex flex-column justify-content-end">
                                            <label for="descripcionCosto">Descripci&oacute;n</label>
                                            <textarea name="Descripcion" class="form-control"
                                                {{$tiene_solicitud == 1 || $caso_cerrado == 1 ? "readonly" : ""}}
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success btn-block"
                                                {{$tiene_solicitud == 1 || $caso_cerrado == 1 ? "disabled" : ""}}>Guardar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-outline-primary btn-block my-2"
                                                data-toggle="modal" data-target="#solicitudModal">Ver
                                                solicitudes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group">
                                <form action="/Caso/{{$Caso->id}}/guardarFactura" enctype="multipart/form-data" class="dropzone"
                                    id="facturaUpload" method="POST">
                                    @csrf
                                    <div class="fallback">
                                        <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                                    </div>
                                    <div class="dz-default dz-message"><span>Suba acá su factura</span></div>
                                </form>
                            </div>   
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">Archivos</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($Archivos as $archivo)
                                <li class="list-group-item"><b><a target="popup"
                                            onclick="window.open('/images/Caso{{$Caso->id}}-{{$archivo}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$archivo}}</a></b>
                                </li>
                                @endforeach
                            </ul>
                            <hr>
                            <div class="form-group">
                                <form action="/Externa/Casos/{{$Caso->id}}/guardarMedia" enctype="multipart/form-data"
                                    class="dropzone" id="fileupload" method="POST">
                                    @csrf
                                    <div class="fallback">
                                        <input name="file" type="files" multiple
                                            accept="image/jpeg, image/png, image/jpg" />
                                    </div>
                                    <div class="dz-default dz-message"><span>Arrastre sus archivos y suelte aquí.</span></div>
                                </form>
                            </div>
                        </div>
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
                                            <b>Nuevo costo: </b><br>{{$solicitud->costo}}
                                            <br>
                                            <p><b>Descripci&oacute;n de solicitud:</b><br>{{$solicitud->descripcion}}
                                            </p>

                                        </div>
                                    </div>
                                    <hr>
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
                    var dz = new Dropzone("#facturaUpload"),
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


    function agregarCausa() {
        var causa = $(".search-input").val();
        $.ajax({
            url: "/Casos/Causas/nueva/" + causa,
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                if (response.estatus == 'guardado') {
                    $('#descripcion_causa_input').val(causa);
                    $('#causa_id').val(response.id);
                    $('#descripcion_causa').show();
                    $('#selectcol').remove();
                    $('#btncol').remove();
                }
                console.log(response);
            }
        });
    }

    tail.select("#descripcion_causa_select", {
        search: true,
        locale: "es",
    });

    @if($Caso->Estatus == 'Cerrado')
    $(document).ready(function () {
        $('#modificarForm :input').prop('disabled', true);
        $('#btnGuardar').prop('disabled', true);
        tail.select("#descripcion_causa_select").disable();

    })
    @endif

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
