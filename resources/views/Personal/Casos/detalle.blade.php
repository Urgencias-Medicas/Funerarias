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

    .nav-tabs > li{
        background-color:#45B5A1;
        border-radius: 8px 8px 0px 0px;
        width: 182px;
        height: 42px;
    }
    .nav-tabs > li > a{
        border: medium none;
        color : white;
        text-align: center;
    }
    .nav-tabs > li > a:hover{
        background-color: #45B5A1 !important;
        border: medium none;
        border-radius: 8px 8px 0px 0px;
        color:#fff;
    }
    .nav-tabs .nav-item .nav-link.active {
        color: #1e1e1e;
        background-color: #FFFFFF !important;
        border: medium none;
        width: 182px;
        height: 42px;
        border-radius: 8px 8px 0px 0px;
    }
    .tab-pane {
        background-color : #FFFFFF;
    }
    .toggle {
        height: 38px!important;
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
@foreach($Descargables as $descargable)
    @php
        $file_parts = pathinfo($descargable['archivo'])    
    @endphp
    @if($file_parts['filename'] != 'Caso'.$Caso->id.'-Factura')
<a href="/images/{{$descargable['archivo']}}" id="descargable-{{$descargable['id']}}" download
    style="display: none;"></a>
    @endif
@endforeach

<div class="container">
    <div class="row my-3">
        <div class="col-12">
            
            <h2>Caso #{{$Caso->id}}</h2>
                @role('Personal')
                    <button type="button" onClick="descargarAdjuntos();" class="btn btn-info float-right mr-2">Generar pdf</button>
                <div class="float-right mx-2">
                    @if($Caso->Reportar == 'Si')
                    <input type="checkbox" checked data-toggle="toggle" data-on="Reportar" data-off="No Reportar"
                        data-onstyle="success" data-offstyle="secondary" onchange="reportar('No')" style="height: 30px!important;">
                    @else
                    <input type="checkbox" data-toggle="toggle" data-on="Reportar" data-off="No Reportar"
                        data-onstyle="success" data-offstyle="secondary" onchange="reportar('Si')">
                    @endif
                </div>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" {{!empty($Caso->Funeraria) ? 'disabled' : ''}}
                    data-target="#funerariaExternaModal" onclick="generarToken({{$Caso->id}});">{{!empty($Caso->token) ? 'Ver' : 'Asignar'}} Funeraria Externa</button>
                <button type="button" class="btn btn-primary float-right mr-2" data-toggle="modal"
                    data-target="#funerariaModal" {{!empty($Caso->token) ? 'disabled' : ''}}>Asignar Funeraria</button>
                <button type="submit" class="btn btn-success float-right mr-2" form="modificarForm">Guardar
                    cambios</button>
                @endrole
                
        </div>
    </div>
    <div class="row my-3">
            <div class="col-lg-12 mx-auto ">
                <ul class="nav nav-tabs">
                    @role('Personal||CHN')
                    <li class="nav-item">
                        <a class="nav-link @role('Personal||CHN') active @endrole" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Caso</a>
                    </li>
                    @endrole
                    @if($Caso->Causa != 'Accidente')
                    @role('Personal||Contabilidad')
                    <li class="nav-item">
                        <a class="nav-link @role('Contabilidad') active @endrole" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pagos</a>
                    </li>
                    @endrole
                    @else
                    <li class="nav-item">
                        <a class="nav-link @role('Contabilidad') active @endrole" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pagos</a>
                    </li>
                    @endif
                    @role('Personal||CHN')
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Archivos</a>
                    </li>
                    @endrole
                    @role('Personal||CHN')
                        @if($Caso->Causa == 'Accidente' && $Caso->Aseguradora_Nombre == 'Seguro Escolar')
                    <li class="nav-item">
                        <a class="nav-link" id="pills-facturas-tab" data-toggle="pill" href="#pills-facturas" role="tab" aria-controls="pills-facturas" aria-selected="false">Facturas</a>
                    </li>
                        @endif
                    @endrole
                    @if($Caso->Estatus == 'Cerrado' && $Caso->Causa == 'Accidente')

                        @role('Personal||CHN')
                        <li class="nav-item">
                            <a class="nav-link" id="pills-chn-tab" data-toggle="pill" href="#pills-chn" role="tab" aria-controls="pills-chn" aria-selected="false">Solicitud CHN</a>
                        </li>
                        @endrole

                    @endif
                </ul>
                {{-- <ul class="nav nav-tabs nav-justified mb-5" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pagos</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Archivos</a>
                    </li>
                </ul> --}}
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade @role('Personal||CHN') show active @endrole pt-3" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <form action="/Casos/{{$Caso->id}}/modificar" id="modificarForm" method="post">
                                <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body align-items-center justify-content-center">
                                            
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
                                                            placeholder="Ingrese el nombre" value="{{$Caso->Nombre}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="edad">Edad</label>
                                                        <input type="text" name="edad" id="edad" class="form-control" value="{{$Caso->Edad}}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="Aseguradora">Aseguradora</label>
                                                        <input type="text" name="aseguradora" id="Aseguradora" class="form-control"
                                                            value="{{$Caso->Aseguradora}}">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="Nombre_Aseguradora">Nombre Aseguradora</label>
                                                        <input type="text" id="Nombre_Aseguradora" class="form-control"
                                                            value="{{$Caso->Nombre_Aseguradora}}">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="causa">Causa</label>
                                                        <select name="causa" id="causa" class="form-control">
                                                            <option {{$Caso->Causa == 'Accidente' ? 'selected' : ''}} value="Accidente">
                                                                Accidente</option>
                                                            <option {{$Caso->Causa == 'Suicidio' ? 'selected' : ''}} value="Suicidio">Suicidio
                                                            </option>
                                                            <option {{$Caso->Causa == 'Asesinato' ? 'selected' : ''}} value="Asesinato">
                                                                Asesinato</option>
                                                            <option {{$Caso->Causa == 'Causas Naturales' ? 'selected' : ''}}
                                                                value="Causas Naturales">Causas Naturales</option>
                                                            <option {{$Caso->Causa == 'Enfermedad Comun' ? 'selected' : ''}}
                                                                value="Enfermedad Comun">Enfermedad Com&uacute;n</option>
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
                                                            class="form-control">
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
                                                        <input type="text" name="causa_especifica" id="causa_especifica" class="form-control"
                                                            value="{{$Caso->Causa_Especifica}}">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="departamento">Departamento</label>
                                                        <select name="departamento" id="departamento" class="form-control" required
                                                            onclick="makeSubmenu(this.value)">
                                                            <option value="{{trim(ucwords(strtolower($Caso->Departamento)))}}">{{trim(ucwords(strtolower($Caso->Departamento)))}}</option>
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
                                                            <option value="Izabal">Izabal</option>s
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
                                                            <option value="{{ucwords(strtolower($Caso->Municipio))}}">{{ucwords(strtolower($Caso->Municipio))}}</option>
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
                                                    <input type="text" name="lugar" id="lugar" class="form-control" value="{{$Caso->Lugar}}">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="certificado">Certificado</label>
                                                        <input type="text" name="certificado" id="certificado" class="form-control"
                                                            value="{{$Caso->Certificado}}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="poliza">Poliza</label>
                                                        <input type="text" name="poliza" id="poliza" class="form-control"
                                                            value="{{$Caso->Poliza}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="NombreReporta">Tipo de asegurado</label>
                                                    <select name="tipoAsegurado" id="tipoAsegurado" class="form-control">
                                                        <option value=""> -- Seleccione -- </option>
                                                        <option value="No Aplica" {{$Caso->TipoAsegurado == 'No Aplica' ? 'selected' : ''}}>No aplica</option>
                                                        <option value="Titular" {{$Caso->TipoAsegurado == 'Titular' ? 'selected' : ''}}>Titular</option>
                                                        <option value="Dependiente" {{$Caso->TipoAsegurado == 'Dependiente' ? 'selected' : ''}}>Dependiente</option>
                                                    </select>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                    <label for="NombreReporta">Nombre de quien reporta</label>
                                                    <input type="text" name="NombreReporta" id="NombreReporta" class="form-control"
                                                        value="{{$Caso->NombreReporta}}">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="RelacionReporta">Relaci&oacute;n</label>
                                                    <input type="text" name="RelacionReporta" id="RelacionReporta" class="form-control"
                                                        value="{{$Caso->RelacionReporta}}">
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
                                                <input type="text" name="Tutor" id="Tutor" class="form-control" value="{{$Caso->Tutor}}">
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
                                                <div class="form-group col-md-4">
                                                    <label for="ParentescoTutor">Parentesco Tutor</label>
                                                    <input type="text" name="ParentescoTutor" id="ParentescoTutor" class="form-control"
                                                        value="{{$Caso->ParentescoTutor}}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="EmailTutor">Email Tutor</label>
                                                    <input type="text" name="EmailTutor" id="EmailTutor" class="form-control"
                                                        value="{{$Caso->EmailTutor}}">
                                                </div>
                                                @php
                                                    $btn_disabled = 1;
                                                @endphp
                                                @if(!isset($Caso->EmailTutor) || $Caso->Mail_Enviado == 1 || !isset($Caso->Aseguradora_Nombre))
                                                    @php
                                                        $btn_disabled = 1;
                                                    @endphp
                                                @else
                                                    @php
                                                        $btn_disabled = 0;
                                                    @endphp
                                                @endif
                                                <div class="form-group col-md-4">
                                                    <label>&nbsp;</label>
                                                    <button id="btn-enviarMail" class="btn btn-warning btn-block" type="button" onclick="EnviarCorreo('{{$Caso->EmailTutor}}', {{$Caso->id}})" {{$btn_disabled == 1 ? 'disabled' : ''}}>Enviar</button>
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
                                                    <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"
                                                        value="{{date('H:i', strtotime($Caso->Hora))}}"><span id="errmsg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                            @role('Personal')
                            <div class="col-md-12 pt-3">
                                <div class="card ">
                                    <div class="card-body align-items-center justify-content-center">
                                        <h4 class="">Evaluaci&oacute;n del servicio funerario</h4>
                                        <form action="/Casos/{{$Caso->id}}/evaluar" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12 p-2 m-0 d-flex flex-column justify-content-end">
                                                    <label for="evaluacion">Puntaje</label>
                                                    <select name="evaluacion" class="form-control" {{$Caso->Estatus != 'Abierto' ? '' : 'disabled'}}
                                                        {{$Caso->Evaluacion == '' ? '' : 'disabled'}}>
                                                        @if($Caso->Evaluacion == '')
                                                        @for($i = 1; $i <= 10; $i+=0.5) <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                            @else
                                                            <option selected>{{$Caso->Evaluacion}}</option>
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="btn btn-outline-primary btn-block my-2" {{$Caso->Estatus != 'Abierto' ? '' : 'disabled'}}
                                                {{$Caso->Evaluacion == '' ? '' : 'disabled'}}>
                                                {{$Caso->Evaluacion == '' ? 'Guardar evaluación' : 'Caso ya evaluado'}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endrole
                        </div>
                    </div>
                    <div class="tab-pane fade @role('Contabilidad') show active @endrole pt-3" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">Costos</div>
                                    <div class="card-body align-items-center justify-content-center">
                                        @if($Caso->Moneda == 'GTQ')
                                        <h6><b>GTQ</b></h6>
                                        <div class="form-row">
                                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                                <label for="costoServicio">Costo</label>
                                                <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? $Caso->Costo_Retencion : $Caso->Costo}}" readonly>
                                            </div>
                                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                                <label for="Pendiente">Pendiente</label>
                                                <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? $Caso->Costo_Retencion - $Caso->Pagado : $Caso->Costo - $Caso->Pagado}}" readonly>
                                            </div>
                                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                                <label for="pagado">Pagado</label>
                                                <input type="text" class="form-control" value="{{isset($Caso->Pagado) ? $Caso->Pagado : '0'}}" readonly>
                                            </div>
                                        </div>   
                                        <h6><b>USD</b></h6>
                                        <div class="form-row">
                                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                                <label for="costoServicio">Costo</label>
                                                <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? $Caso->Costo_Retencion/$Tasa_Cambio : $Caso->Costo/$Tasa_Cambio}}" readonly>
                                            </div>
                                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                                <label for="Pendiente">Pendiente</label>
                                                <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? ($Caso->Costo_Retencion - $Caso->Pagado)/$Tasa_Cambio : ($Caso->Costo - $Caso->Pagado)/$Tasa_Cambio}}" readonly>
                                            </div>
                                            <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                                                <label for="pagado">Pagado</label>
                                                <input type="text" class="form-control" value="{{isset($Caso->Pagado) ? $Caso->Pagado/$Tasa_Cambio : '0'}}" readonly>
                                            </div>
                                        </div> 
                                        @else
                                        <h6><b>USD</b></h6>
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="costoServicio">Costo</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>        
                                                    <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? $Caso->Costo_Retencion : $Caso->Costo}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="Pendiente">Pendiente</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>     
                                                    <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? $Caso->Costo_Retencion - $Caso->Pagado : $Caso->Costo - $Caso->Pagado}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="pagado">Pagado</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>      
                                                    <input type="text" class="form-control" value="{{isset($Caso->Pagado) ? $Caso->Pagado : '0'}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <h6><b>GTQ</b></h6>
                                        <div class="form-row">
                                        <div class="col">
                                            <label for="basic-url">Costo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Q</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? $Caso->Costo_Retencion*$Tasa_Cambio : $Caso->Costo*$Tasa_Cambio}}" readonly>
                                            </div>
                                        </div>              

                                        <div class="col">
                                            <label for="basic-url">Pendiente</label>
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Q</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$Caso->Costo_Retencion ? ($Caso->Costo_Retencion - $Caso->Pagado)*$Tasa_Cambio : ($Caso->Costo - $Caso->Pagado)*$Tasa_Cambio}}" readonly>
                                            </div>
                                        </div>              
                                            
                                        <div class="col">
                                            <label for="basic-url">Pagado</label>
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Q</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{isset($Caso->Pagado) ? $Caso->Pagado*$Tasa_Cambio : '0'}}" readonly>
                                            </div>
                                        </div>              
                                            
                                        </div> 
                                        @endif
                                        <hr>

                                        <form action="/Caso/{{$Caso->id}}/ISR" enctype="multipart/form-data" method="post" >
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="retencion">ISR</label>
                                                    <input type="text" name="retencion" id="retencion" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                            value="{{$Caso->ISR}}" {{$Caso->ISR ? 'disabled' : ''}}>
                                                </div>
                                                <div class="col">
                                                    <label for="Comprobante">Comprobante</label>
                                                    <input type="file" name="comprobante" id="comprobante" class="form-control" {{$Caso->ISR ? 'disabled' : ''}} required>
                                                </div>
                                                <div class="col">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-outline-info btn-block" {{$Caso->ISR ? 'disabled' : ''}}>Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <h4>Retención de ISR: </h4> <h5><a href="{{$Caso->Comprobante_ISR}}" target="_blank">Ver</a></h5>
                                            </div>
                                        </div>
                                        <hr>
                                        @if(isset($Caso->token))
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Nombre Funeraria Externa</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{$Caso->Funeraria_Externa_Nombre}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>NIT Funeraria Externa</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{$Caso->Funeraria_Externa_NIT}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Banco Funeraria Externa</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{$Caso->Funeraria_Externa_Banco}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>No. Cuenta Funeraria Externa</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{$Caso->Funeraria_Externa_NoCuenta}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="Documento">Documento</label><br>
                                                <b><a href="{{$Caso->Funeraria_Externa_Comprobante}}" target="_blank">Ver</a></b>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                    @role('Personal||CHN||Contabilidad')
                                    <div class="card mb-3">
                                        <div class="card-body ">
                                        @role('Personal||CHN')
                                        @if($Caso->Solicitud == 'Pendiente' || $Caso->Solicitud == 'Preaprobar')
                                            <button type="button" class="btn btn-outline-info btn-block my-2" data-toggle="modal"
                                                data-target="#solicitudModal">Solicitud Nueva</button>
                                        @else
                                            <button type="button" class="btn btn-outline-primary btn-block my-2" data-toggle="modal"
                                                data-target="#solicitudModal">Ver solicitudes</button>
                                        @endif
                                        @endrole
                                            <a href="{{$Caso->Factura}}" target="_blank"><button type="button" class="btn btn-outline-primary btn-block my-2" {{isset($Caso->Factura) ? '' : 'disabled'}}>Ver factura</button></a>
                                        </div>
                                    </div>
                                    @endrole
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="mt-3">Historial de Pagos</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Pago</th>
                                                                <th scope="col">Serie</th>
                                                                <th scope="col">Factura</th>
                                                                <th scope="col">Monto</th>
                                                                <th scope="col">Comprobante</th>
                                                                <th scope="col">Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($Pagos as $Pago)
                                                            <tr>
                                                                <td>{{$Pago->id}}</td>
                                                                <td>{{$Pago->serie}}</td>
                                                                <td>{{$Pago->factura}}</td>
                                                                <td>{{$Pago->monto}}</td>
                                                                <td><a href="{{$Pago->comprobante}}">Ver</a></td>
                                                                <td>{{date("d-m-Y", strtotime("$Pago->fecha"))}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            @role('Personal||Contabilidad')
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <h4>Registrar Pagos</h4>
                                                </div>
                                                <div class="col-md-6 text-right mb-3">
                                                    <button type="button" class="btn btn-success" onClick="agregarFila();"><i class="fa fa-plus"
                                                            aria-hidden="true"></i></button>
                                                    <button type="button" id="quitarFila" class="btn btn-danger" onClick="quitarFila();"
                                                        disabled><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                            <form action="/Casos/{{$Caso->id}}/actualizarPago" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                        <table class="table text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Serie</th>
                                                                    <th scope="col">Factura</th>
                                                                    <th scope="col">Monto</th>
                                                                    <th scope="col">Fecha</th>
                                                                    <th scope="col">Comprobante</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tablaPagos">
                                                                <tr class="fila1">
                                                                    <td><input name="serie1" type="text" class="form-control" required></td>
                                                                    <td><input name="factura1" type="text" class="form-control" required></td>
                                                                    <td><input name="monto1" type="text" class="form-control"
                                                                            onkeypress="return validateFloatKeyPress(this,event);" required></td>
                                                                    <td><input name="fecha1" type="date" class="form-control" required></td>
                                                                    <td><input type="file" name="comprobante1" class="form-control" required></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <input type="hidden" name="filas" id="filas" value="1">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @endrole
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-4">
                                    <div class="card-header">Archivos</div>
                                    <div class="card-body align-items-center justify-content-center">
                                        @role('Personal')
                                        <ul class="list-group">
                                            <form action="/Personal/Reportes/Caso/{{$Caso->id}}" id="generarReporte" method="get">
                                                @foreach($Archivos as $archivo)
                                                    @php
                                                        $file_parts = pathinfo($archivo)    
                                                    @endphp
                                                    @if($file_parts['filename'] != 'Factura')
                                                <li class="list-group-item"><b>
                                                    @if($file_parts['extension'] == 'jpg' || $file_parts['extension'] == 'png' || $file_parts['extension'] == 'jfif' || $file_parts['extension'] == 'jpeg')
                                                        
                                                        <input type="checkbox" name="descargar[]" value="/images/Caso{{$Caso->id}}-{{$archivo}}"> 
                                                        
                                                    @endif
                                                    
                                                    <a target="popup"
                                                            onclick="window.open('/images/Caso{{$Caso->id}}-{{$archivo}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$archivo}}</a></b>
                                                            
                                                    @if($Documentos_CHN->isEmpty())
                                                        <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No"
                            data-onstyle="success" data-offstyle="secondary" onchange="documentoCHN('Si', '{{$archivo}}')">
                                                    @else
                                                        @if(!in_array($archivo, $Documentos_CHN->pluck('ruta')->toArray()))
                                                            <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No"
                            data-onstyle="success" data-offstyle="secondary" onchange="documentoCHN('Si', '{{$archivo}}')">
                                                        @else
                                                            <input type="checkbox" checked data-toggle="toggle" data-on="Si" data-off="No"
                            data-onstyle="success" data-offstyle="secondary" onchange="documentoCHN('No', '{{$archivo}}')">
                                                        @endif
                                                    @endif
                                                </li>
                                                @endif
                                                @endforeach
                                            </form>
                                        </ul>
                                        @endrole
                                        @role('CHN')
                                        <ul class="list-grouo">
                                            @foreach($Documentos_CHN as $documento)
                                            <li class="list-group-item">
                                                <b>
                                                    <a target="popup"
                                                            onclick="window.open('/images/Caso{{$Caso->id}}-{{$documento->ruta}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$documento->ruta}}</a></b>
                                                </b>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endrole
                                        <hr>
                                        <div class="form-group">
                                            <form action="/Caso/{{$Caso->id}}/guardarMedia" enctype="multipart/form-data" class="dropzone"
                                                id="fileupload" method="POST">
                                                @csrf
                                                <div class="fallback">
                                                    <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                                                </div>
                                                <div class="dz-default dz-message"><span>Arrastre sus archivos y suelte aquí.</span></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-facturas" role="tabpanel" aria-labelledby="pills-facturas-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-4">
                                    <div class="card-header">Facturas y comprobantes</div>
                                    <div class="card-body align-items-center justify-content-center">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Factura</th>
                                                        <th>Estatus</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Facturas as $factura)
                                                    <tr>
                                                        <td>{{$factura->id}}</td>
                                                        <td>{{$factura->estatus}}</td>
                                                        <td>
                                                            <a href="{{$factura->ruta}}" target="_blank" class="btn btn-primary">Ver</a>
                                                            @role('CHN')
                                                                @if($factura->estatus == 'Pendiente')
                                                                <a href="/Caso/factura/{{$factura->id}}/Aprobada" class="btn btn-success">Aprobar</a>
                                                                <a href="/Caso/factura/{{$factura->id}}/Denegada" class="btn btn-danger">Denegar</a>
                                                                @endif
                                                            @endrole
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Comprobante</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Comprobantes as $comprobante)
                                                    <tr>
                                                        <td>{{$comprobante->id}}</td>
                                                        <td>
                                                            <a href="{{$comprobante->ruta}}" target="_blank" class="btn btn-primary">Ver</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @role('CHN')
                                        <div class="form-group">
                                            <form action="/Caso/{{$Caso->id}}/guardarFacturaUM" enctype="multipart/form-data" class="dropzone"
                                                id="comprobanteupload" method="POST">
                                                @csrf
                                                <div class="fallback">
                                                    <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                                                </div>
                                                <div class="dz-default dz-message"><span>Arrastre sus archivos y suelte aquí.</span></div>
                                            </form>
                                        </div>
                                        @endrole
                                        @role('Personal')
                                        @php
                                        $tiene_solicitud = 0;
                                        @endphp
                                        @foreach($Facturas as $factura)
                                            @if($factura->estatus == 'Pendiente')
                                                @php
                                                    $tiene_solicitud = 1
                                                @endphp
                                            @endif
                                        @endforeach
                                        <hr>
                                        <div class="form-group" style="display:{{$tiene_solicitud == 1 ? 'none' : ''}}">
                                            <form action="/Caso/{{$Caso->id}}/guardarFacturaUM" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <h4><b>Subir factura</b></h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input name="file" type="file" multiple accept="image/jpeg, image/png, image/jpg" class="form-control"/>
                                                        </div>
                                                        <div class="col">
                                                            <button class="btn btn-primary btn-block">Subir</button>
                                                        </div>
                                                    </div>

                                                <!--<div class="dz-default dz-message"><span>Arrastre sus archivos y suelte aquí.</span></div>-->
                                            </form>
                                        </div>
                                        @endrole
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-chn" role="tabpanel" aria-labelledby="pills-chn-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-4">
                                    <div class="card-header">Solicitud CHN</div>
                                    <div class="card-body align-items-center justify-content-center">
                                        @role('CHN')
                                        <div class="row">
                                            <div class="col">
                                                @if($Caso->Estatus_CHN != '')

                                                    <b>Estado actual: </b> {{$Caso->Estatus_CHN == 'Denegar' ? 'Denegado' : 'Aprobado'}}

                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                @if($Caso->Estatus_CHN != '')

                                                    <b>Observaciones: </b> {{$Caso->Observaciones_CHN}}

                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <form action="/Caso/{{$Caso->id}}/CHNEstatus" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="TelTutor">Observaciones</label>
                                                    <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="estatus" id="chnestatusvalue" value="">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <button class="btn btn-danger btn-block" onmouseover="chnestatus('Denegar');">Denegar</button>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <button class="btn btn-success btn-block" onmouseover="chnestatus('Aprobar');">Aprobar</button>
                                                </div>
                                            </div>
                                        </form>
                                        @endrole
                                        @role('Personal')

                                            @if($Caso->Estatus_CHN == '')

                                            <div class="row">
                                                <div class="col text-center">
                                                    <h3><b>Pendiente</b></h3>
                                                </div>
                                            </div>

                                            @elseif($Caso->Estatus_CHN == 'Denegar')

                                            <div class="row">
                                                <div class="col text-center">
                                                    <h3 style="color: red;"><b>Denegado</b></h3>
                                                    <h5><b>{{$Caso->Observaciones_CHN}}</b></h5>
                                                </div>
                                            </div>

                                            @elseif($Caso->Estatus_CHN == 'Aprobar')

                                            <div class="row">
                                                <div class="col text-center">
                                                    <h3 style="color:green;"><b>Aprobado</b></h3>
                                                </div>
                                            </div>

                                            @endif

                                        @endrole
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @role('Personal')
    <div class="row">
        <div class="col-md-6">
            
            <div class="card mt-3 border-danger">
                <div class="card-body align-items-center justify-content-center">
                    <h4>¿Desea cerrar el caso?</h4>
                    @if($Caso->Estatus == 'Cerrado')
                    <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#cerrarModal"
                        disabled>Cerrar caso</button>
                    @else
                    <button type="button" class="btn btn-danger mt-2" data-toggle="modal"
                        data-target="#cerrarModal">Cerrar
                        caso</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endrole
</div>
<!-- Modal -->
<div class="modal fade" id="funerariaModal" tabindex="-1" role="dialog" aria-labelledby="funerariaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="funerariaModalLabel">Asignar Funeraria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-funerarias">

            </div>
            <div class="modal-footer" id="footer-modal-funerarias">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cargarFunerarias();">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="funerariaExternaModal" tabindex="-1" role="dialog" aria-labelledby="funerariaExternaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="funerariaExternaModalLabel">Asignar Funeraria Externa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-funeraria-externa">
                    <input type="text" name="token_funerariaExterna" id="tokenFunerariaExterna" class="form-control">
            </div>
            <div class="modal-footer" id="footer-modal-funeraria-externa">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="modificarCausaModal" tabindex="-1" role="dialog" aria-labelledby="modificarCausaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarCausaModalLabel">Modificar causa de muerte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-causa">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/Casos/{{$Caso->id}}/Causas/actualizar" method="post">
                                @csrf
                                <input type="hidden" name="causa_id" id="causa_id">
                                <div class="form-row">
                                    <div class="form-group col-md-12" id="descripcion_causa" style="display: none;">
                                        <label for="descripcion_causa">Causa de muerte</label>
                                        <input type="text" class="form-control" id="descripcion_causa_input"
                                            name="descripcion_causa">
                                    </div>
                                    <div class="form-group col-md-10" id="selectcol">

                                        <label for="descripcion_causa">Causa de muerte</label>
                                        <select name="descripcion_causa_select" id="descripcion_causa"
                                            class="selectpicker form-control" data-live-search="true">
                                            @foreach($Causas as $causa)
                                            <option value="{{$causa->Causa}}">{{$causa->Causa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2" id="btncol">
                                        <label for="btn-nueva">Nueva causa</label>
                                        <button type="button" class="btn btn-primary btn-block"
                                            onclick="agregarCausa();">+</button>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-block">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>-->

<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-detalle">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="campaniaModal" tabindex="-1" role="dialog" aria-labelledby="campaniaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campaniaLabel">Seleccione la campaña para asignar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-campania">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-secondary" id="btn-asignar-campania" data-dismiss="modal">Asignar</button>
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
                <h3>¿Est&aacute; seguro que desea cerrar el caso?</h3>
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
                                    @elseif($solicitud->estatus == 'Preaprobar')
                                    <span class="text-success">Pre-Aprobada</span>
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
                                    <!--@if($Caso->Causa != 'Accidente' && $Caso->Aseguradora_Nombre != 'Seguro Escolar')
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
                                    @endif-->
                                    @role('Personal')
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
                                    @endrole
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
                    var dz = new Dropzone("#comprobanteupload"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };
                    /*var dz = new Dropzone("#facturaupload"),
                        dze_info = $("#dze_info"),
                        status = {
                            uploaded: 0,
                            errors: 0
                        };*/
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
        $('.alert').alert();
        cargarFunerarias();
    });

    @role('CHN')
    $(document).ready(function () {
        $('#modificarForm :input').prop('disabled', true);
        $('#btnGuardar').prop('disabled', true);
        $('#btn-enviarMail').prop('disabled', true);
        tail.select("#descripcion_causa_select").disable();

    })
    @endrole

    function EnviarCorreo(mail, caso){
        $.ajax({
            url: '/Personal/sendMail/'+mail+'/'+caso,
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                
            }
        });
        location.reload();
    }

    function generarToken(caso){
        console.log('test');
        $.ajax({
            url: '/Personal/generarToken/'+caso,
            type: 'get',
            dataType: 'TEXT',
            success: function (response) {
                $('#tokenFunerariaExterna').val(response);     
                console.log(response);
            }
        });
    }

    function cargarFunerarias(){
        $.ajax({
            url: "/verFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                html += '<div class="row mt-4">\
                            <div class="col-7">\
                            <h4>Seleccione los medios por los cuales desea notificar a la funeraria.</h4>\
                            </div>\
                            <div class="col-5 text-center">\
                                <div class="form-check form-check-inline">\
                                    <input class="form-check-input" type="checkbox" id="Correo" value="Si" style="width:20px; height:20px;" onchange="habilitarAsignar();">\
                                    <label class="form-check-label" for="Correo"><h5>Correo</h5></label>\
                                </div>\
                                <div class="form-check form-check-inline">\
                                    <input class="form-check-input" type="checkbox" id="WhatsApp" value="Si" style="width:20px; height:20px;" disabled onchange="habilitarAsignar();">\
                                    <label class="form-check-label" for="WhatsApp"><h5>WhatsApp</h5></label>\
                                </div>\
                            </div>\
                        </div>\
                        <hr class="my-4">';
                for (var i = 0; i < len; i++) {
                    if (response[i].departamento == "{{strtoupper($Caso->Departamento)}}" ||
                        response[i].departamento == "{{strtolower($Caso->Departamento)}}") {
                        html += '<h5>Recomendada</h5>\
                        <table class="table table-light table-striped border rounded">\
                            <thead class="">\
                                <tr>\
                                    <th scope="col">Nombre</th>\
                                    <th scope="col">Departamento</th>\
                                    <th scope="col">Tel.</th>\
                                    <th scope="col">Acciones</th>\
                                </tr>\
                            </thead>\
                            <tbody>\
                                <tr>\
                                    <td>' + response[i].funeraria + '</td>\
                                    <td>' + response[i].departamento + '</td>\
                                    <td>' + response[i].tel_contacto +
                            '</td>\
                                    <td><button class="btn btn-outline-info" id="idFuneraria" onclick="detalleFuneraria(' +
                            response[i].id +
                            ')">Ver</button> <button disabled class="btn btn-primary asignar" onclick="seleccionarCampania(' +
                            response[i].id + ')">Asignar</button></td>\
                                </tr>\
                            </tbody>\
                        </table><hr class="my-4">';
                    }
                }

                html += '<h5>Funerarias</h5>\
                        <table class="table table-light table-striped border rounded">\
                            <thead class="">\
                                <tr>\
                                    <th scope="col">Nombre</th>\
                                    <th scope="col">Departamento</th>\
                                    <th scope="col">Tel.</th>\
                                    <th scope="col">Acciones</th>\
                                </tr>\
                            </thead>\
                            <tbody>';
                for (var j = 0; j < len; j++) {
                    if (response[j].departamento != "{{strtoupper($Caso->Departamento)}}" ||
                        response[j].departamento != "{{strtolower($Caso->Departamento)}}") {
                        html += '<tr>\
                                    <td>' + response[j].funeraria + '</td>\
                                    <td>' + response[j].departamento + '</td>\
                                    <td>' + response[j].tel_contacto +
                            '</td>\
                                    <td><button class="btn btn-outline-info" id="idFuneraria" onclick="detalleFuneraria(' +
                            response[j].id +
                            ')">Ver</i></button> <button disabled class="btn btn-primary asignar" onclick="seleccionarCampania(' +
                            response[j].id + ')">Asignar</button></td>\
                                </tr>';
                    }
                }
                html += '</tbody>\
                        </table><br>';
                $('#modal-funerarias').html(html);
            }
        });
    }

    function seleccionarCampania(id){
        $.ajax({
            url: "/verFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                var costo_servicio = 0;
                var btn_asignar = '<button type="button" class="btn btn-info" onclick="cargarFunerarias();">Volver</button><button type="button" class="btn btn-secondary" id="btn-asignar-campania" data-dismiss="modal">Asignar</button><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                for (let i = 0; i < len; i++) {
                    if (response[i].id == id) {

                        var infoFuneraria = getInfoFuneraria(id);

                        html += '<p>Campañas:</p>\
                            <div class="row">\
                                <div class="col-md-12">\
                                    <select id="campania_id" class="form-control">\
                                    <option disabled selected>-- Seleccione una campaña --</option>';
                        $.each(JSON.parse(infoFuneraria.Campanias), function(key, entry){
                            //if($('#edad').val() >= entry.edad_inicial && $('#edad').val() <= entry.edad_final){
                                html += '<option value="'+entry.id+'"> ['+entry.edad_inicial+'-'+entry.edad_final+'] - '+entry.nombre+'</option>';
                            //}else{
                            //    html += '<option value="'+entry.id+'" disabled>'+entry.nombre+'</option>';
                            //}
                                    
                        });

                        html += '</select>\
                                </div>';
                    }
                }
                $('#footer-modal-funerarias').html(btn_asignar);
                $('#btn-asignar-campania').attr("onclick", 'preAsignarFuneraria({{$Caso->id}},'+id + ')');
                $('#modal-funerarias').html(html);
                //$('#campaniaModal').modal('show');
                console.log('done');
            },
            error: function (response) {
                alert('Por favor rellene la información de la funeraria.');
            }
        });
    }

    function detalleFuneraria(id) {
        $.ajax({
            url: "/verFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                var costo_servicio = 0;
                for (let i = 0; i < len; i++) {
                    if (response[i].id == id) {

                        var infoFuneraria = getInfoFuneraria(id);

                        html = '<h3>' + response[i].funeraria + '</h3>\
                        <p>Direcci&oacute;n:<br> ' + response[i].direccion + '</p>\
                        <p>Departamento:<br> ' + response[i].departamento + '</p>\
                        <p>Correo electrónico:<br> ' + infoFuneraria.Email + '</p>\
                        <p>Tel. Contacto:<br> ' + response[i].tel_contacto + '</p>\
                        <p>Tel. Coordinador:<br> ' + response[i].tel_coordinador + '</p>\
                        </div>';
                    }
                }
                var btn_asignar = '<button type="button" class="btn btn-info" onclick="cargarFunerarias();">Volver</button><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                $('#footer-modal-funerarias').html(btn_asignar);
                $('#modal-funerarias').html(html);
                //$('#detalleModal').modal('show');
            },
            error: function (response) {
                alert('Por favor rellene la información de la funeraria.');
            }
        });
    }

    function getInfoFuneraria(id) {
        var costo_servicio = 0;
        var result = '';
        $.ajax({
            url: "/Casos/getInfoFuneraria/" + id,
            type: 'get',
            async: false,
            dataType: 'JSON',
            success: function (response) {
                result = response;
            },
            error: function (response) {
                result = {
                    "Email": "Rellene la información",
                    "Monto_Base": 0
                };
                alert('Por favor rellene la información de la funeraria.');
            }
        });
        return result;
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
        var campania = $('#campania_id').val();

        var regExp = /\(([^)]+)\)/;
        var moneda = regExp.exec($('#campania_id option:selected').text());

        console.log(moneda[1]);

        asignarFuneraria(caso, id, campania, moneda[1], correo, whatsapp);
    }

    function asignarFuneraria(caso, id, campania, moneda, correo, wp) {
        $.ajax({
            url: "/Casos/" + caso + "/asignarFuneraria/" + id + "/" + campania + "/" + moneda + "/" + correo + "/" + wp,
            type: 'get',
            success: function (response) {
                window.location.href = '/Casos/ver';
            },
            error: function (response) {
                alert('Por favor rellene la información de la funeraria.');
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
            <td><input name="serie' + nuevafila + '" type="text" class="form-control" required></td>\
            <td><input name="factura' + nuevafila + '" type="text" class="form-control" required></td>\
            <td><input name="monto' + nuevafila + '" type="text" class="form-control" onkeypress="return validateFloatKeyPress(this,event);" required></td>\
            <td><input name="fecha' + nuevafila + '" type="date" class="form-control" required></td>\
            <td><input type="file" name="comprobante' + nuevafila + '" class="form-control" required></td>\
        </tr>';
        $('#tablaPagos').append(html);

        if (nuevafila != 1) {
            $('#quitarFila').prop('disabled', false);
        }
    }

    function quitarFila() {
        var fila = $('#filas').val();
        var nuevafila = parseInt(fila) - 1;
        $('#filas').val(nuevafila);
        if (fila == 1 || nuevafila == 1) {
            $('#quitarFila').prop('disabled', true);
        }
        $('.fila' + fila).remove();
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

    function documentoCHN(opcion, archivo){
        $.ajax({
            url: "/Caso/{{$Caso->id}}/documento/" + archivo + "/" + opcion,
            type: 'get',
            sucess: function (response) {
                console.log('done');
            }
        })
    }

    function validateFloatKeyPress(el, evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        var number = el.value.split('.');
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        //get the carat position
        var caratPos = getSelectionStart(el);
        var dotPos = el.value.indexOf(".");
        if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
            return false;
        }
        return true;
    }

    //thanks: http://javascript.nwbox.com/cursor_position/
    function getSelectionStart(o) {
        if (o.createTextRange) {
            var r = document.selection.createRange().duplicate()
            r.moveEnd('character', o.value.length)
            if (r.text == '') return o.value.length
            return o.value.lastIndexOf(r.text)
        } else return o.selectionStart
    }

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

    function descargarAdjuntos() {
        @if(empty($Descargables))
            document.getElementById("generarReporte").submit();
        @else
            @foreach($Descargables as $descargable)
            document.getElementById("descargable-{{$descargable['id']}}").click();
            document.getElementById("generarReporte").submit();
            @endforeach
        @endif
    }

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (
            event) {
            textbox.addEventListener(event, function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }

    function chnestatus(estatus){
        $('#chnestatusvalue').val(estatus)
    }

    $(document).ready(function () {

        convertMunJson();

        setInputFilter(document.getElementById("TelPadre"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelMadre"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelTutor"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("DPITutor"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelReporta"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });

        tail.select("#descripcion_causa_select", {
            search: true,
            locale: "es",
        });

    });

    let municipios = {!! $Json !!}

    function convertMunJson(){
        var keys = [];
        for(var k in municipios) keys.push(k);

        keys.forEach(function(element, index){

            let content = []
            content = municipios[element];
            delete municipios[element];

            let new_key_name = element.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
            console.log(new_key_name);
            //municipio.[new_key_name] = content;
            municipios[`${new_key_name}`] = content;
        })

    }

    function makeSubmenu(value) {
        value = value.normalize("NFD").replace(/[\u0300-\u036f]/g, "")


        if (value.length == 0) {
            $('#municipio').html = "<option></option>";
        } else {
            var munOptions = "";

            for (munId in municipios[value]) {

                if('{{trim(ucwords(strtolower($Caso->Municipio)))}}' == municipios[value][munId].normalize("NFD").replace(/[\u0300-\u036f]/g, "")){
                        munOptions += "<option value='" + municipios[value][munId] + "' selected>" + municipios[value][munId] +
                    "</option>";
                }else{
                        munOptions += "<option value='" + municipios[value][munId] + "'>" + municipios[value][munId] +
                    "</option>";
                }
            }
            document.getElementById("municipio").innerHTML = munOptions;
        }
    }

</script>
@endsection
