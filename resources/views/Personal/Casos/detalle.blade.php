@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
@if(!empty($alerta))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$alerta}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container">
    <div class="row my-3">
        <div class="col-12">
            <button type="button" class="btn btn-link"><a href="/Casos/ver">
                    < Atrás</a> </button> <div class="float-right mx-2">
                        @if($Caso->Reportar == 'Si')
                        <input type="checkbox" checked data-toggle="toggle" data-on="Reportar" data-off="No Reportar"
                            data-onstyle="success" data-offstyle="secondary" onchange="reportar('No')">
                        @else
                        <input type="checkbox" data-toggle="toggle" data-on="Reportar" data-off="No Reportar"
                            data-onstyle="success" data-offstyle="secondary" onchange="reportar('Si')">
                        @endif
        </div>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
            data-target="#funerariaModal">Asignar Funeraria</button>
        <button type="submit" class="btn btn-success float-right mr-2" form="modificarForm">Guardar cambios</button>
    </div>
</div>
<div class="row ">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Detalles caso - #<b>{{$Caso->id}}</b></div>

            <div class="card-body align-items-center justify-content-center">
                <form action="/Casos/{{$Caso->id}}/modificar" id="modificarForm" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="Agente">Agente</label>
                        <input type="text" class="form-control" id="Agente" name="Agente" placeholder=""
                            value="{{$Caso->Agente}}" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="codEstudiante">Cód. Estudiante</label>
                        <input type="text" class="form-control" id="codEstudiante" name="codEstudiante" placeholder=""
                            value="{{$Caso->Codigo}}" readonly><span id="errmsg"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Ingrese nombre del estudiante" value="{{$Caso->Nombre}}" readonly>
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
                        <input type="text" class="form-control" id="descripcion_causa_input" name="descripcion_causa">
                    </div>
                    <div class="form-group col-md-8" id="selectcol">

                        <label for="descripcion_causa">Causa de muerte</label>
                        <select name="descripcion_causa_select" id="descripcion_causa" class="selectpicker form-control"
                            data-live-search="true">
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
                        <button type="button" class="btn btn-primary btn-block" onclick="agregarCausa();">+</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="departamento">Departamento</label>
                        <input type="text" name="departamento" id="departamento" class="form-control"
                            value="{{$Caso->Departamento}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="municipio">Municipio</label>
                        <input type="text" name="municipio" id="municipio" class="form-control"
                            value="{{$Caso->Municipio}}">
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
                            value="{{$Caso->TelReporta}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="padre">Padre</label>
                        <input type="text" name="padre" id="padre" class="form-control" value="{{$Caso->Padre}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TelPadre">Tel. Padre</label>
                        <input type="text" name="TelPadre" id="TelPadre" class="form-control"
                            value="{{$Caso->TelPadre}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="madre">Madre</label>
                        <input type="text" name="madre" id="madre" class="form-control" value="{{$Caso->Madre}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TelMadre">Tel. Madre</label>
                        <input type="text" name="TelMadre" id="TelMadre" class="form-control"
                            value="{{$Caso->TelMadre}}">
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
                            value="{{$Caso->TelTutor}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="DPITutor">DPI Tutor</label>
                        <input type="text" name="DPITutor" id="DPITutor" class="form-control"
                            value="{{$Caso->DPITutor}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ParentescoTutor">Parentesco Tutor</label>
                        <input type="text" name="ParentescoTutor" id="ParentescoTutor" class="form-control"
                            value="{{$Caso->ParentescoTutor}}">
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
                            cols="80">{{$Caso->ComentarioTutor}}</textarea>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Medico">Agente que atendi&oacute;</label>
                        <input type="text" name="Medico" id="Medico" class="form-control" value="{{$Caso->Medico}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="idioma">Idioma</label>
                        <input type="text" name="Idioma" id="Idioma" class="form-control" value="{{$Caso->Idioma}}">
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
                            value="{{date('G:i', strtotime($Caso->Hora))}}"><span id="errmsg"></span>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="card mt-3 border-danger">
            <div class="card-body align-items-center justify-content-center">
                <h4>¿Desea cerrar el caso?</h4>
                @if($Caso->Estatus == 'Cerrado')
                <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#cerrarModal"
                    disabled>Cerrar caso</button>
                @else
                <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#cerrarModal">Cerrar
                    caso</button>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">Costos</div>
            <div class="card-body align-items-center justify-content-center">
                <div class="form-row">
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
                @if($Caso->Solicitud != 'Pendiente')
                <button type="button" class="btn btn-outline-primary btn-block my-2" data-toggle="modal"
                    data-target="#solicitudModal">Ver solicitudes</button>
                @else
                <button type="button" class="btn btn-outline-info btn-block my-2" data-toggle="modal"
                    data-target="#solicitudModal">Solicitud Nueva</button>
                @endif
                <hr>
                <h4 class="mt-3">Evaluaci&oacute;n del servicio funerario</h4>

                <form action="/Casos/{{$Caso->id}}/evaluar" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="evaluacion">Puntaje</label>
                            <select name="evaluacion" class="form-control"
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
                    <button class="btn btn-outline-primary btn-block my-2"
                        {{$Caso->Evaluacion == '' ? '' : 'disabled'}}>
                        {{$Caso->Evaluacion == '' ? 'Guardar evaluaci&oacute;n' : 'Caso ya evaluado'}}</button>
                </form>

                <hr>
                <h4 class="mt-3">Historial de Pagos</h4>
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
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h4>Registrar Pagos</h4>
                    </div>
                    <div class="col-md-6 text-right mb-3">
                        <button type="button" class="btn btn-success" onClick="agregarFila();"><i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                        <button type="button" id="quitarFila" class="btn btn-danger" onClick="quitarFila();" disabled><i
                                class="fa fa-minus" aria-hidden="true"></i></button>
                    </div>
                </div>
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
                                        <td><input name="monto1" type="text" class="form-control"
                                                onkeypress="return validateFloatKeyPress(this,event);"></td>
                                        <td><input name="fecha1" type="date" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="filas" id="filas" value="1">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Archivos</div>
            <div class="card-body align-items-center justify-content-center">
                <ul class="list-group">
                    @foreach($Archivos as $archivo)
                    <li class="list-group-item"><b><a target="popup"
                                onclick="window.open('/images/Caso{{$Caso->id}}-{{$archivo}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$archivo}}</a></b>
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
                <h5 class="modal-title" id="funerariaModalLabel">Asignar Funeraria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-funerarias">

            </div>
            <div class="modal-footer">
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
        $('.alert').alert();
        $.ajax({
            url: "https://umbd.excess.software/api/getFunerarias",
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
                            ')">Ver</button> <button disabled class="btn btn-primary asignar" onclick="preAsignarFuneraria({{$Caso->id}},' +
                            response[i].id + ',' + '\'' + response[i].funeraria + '\'' +')">Asignar</button></td>\
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
                            ')">Ver</i></button> <button disabled class="btn btn-primary asignar" onclick="asignarFuneraria({{$Caso->id}},' +
                            response[j].id + ',' + '\'' + response[j].funeraria + '\'' +')">Asignar</button></td>\
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

                        html = '<h3>' + response[i].funeraria + '</h3>\
                        <p>Direcci&oacute;n:<br> ' + response[i].direccion + '</p>\
                        <p>Departamento:<br> ' + response[i].departamento + '</p>\
                        <p>Tel. Contacto:<br> ' + response[i].tel_contacto + '</p>\
                        <p>Tel. Coordinador:<br> ' + response[i].tel_coordinador + '</p>\
                        <p>Costo del servicio:<br> <b>Q' + costo_servicio + '</b></p>';
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

    function preAsignarFuneraria(caso, id, funeraria) {
        var correo = 'No';
        var whatsapp = 'No';
        var valor = 'No';
        if ($('#Correo').is(':checked')) {
            correo = 'Si';
        }
        if ($('#WhatsApp').is(':checked')) {
            whatsapp = 'Si';
        }
        asignarFuneraria(caso, id, funeraria, correo, whatsapp);
    }

    function asignarFuneraria(caso, id, funeraria, correo, wp) {
        $.ajax({
            url: "/Casos/" + caso + "/asignarFuneraria/" + id + "/" + funeraria + "/" + +correo + "/" + wp,
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
                //window.location.href = '/Casos/ver';
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
            <td><input name="monto' + nuevafila + '" type="text" class="form-control" onkeypress="return validateFloatKeyPress(this,event);"></td>\
            <td><input name="fecha' + nuevafila + '" type="date" class="form-control"></td>\
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
        var causa = $(".bs-searchbox input").val();
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

    $(document).ready(function () {
        setInputFilter(document.getElementById("TelPadre"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelMadre"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelTutor"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelReporta"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });

    });

</script>
@endsection
