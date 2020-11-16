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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear nuevo caso</div>

                <div class="card-body align-items-center justify-content-center">
                    <form action="/Casos/guardarNuevo" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="codEstudiante">Código de Estudiante</label>
                                <input type="text" class="form-control" id="codEstudiante" name="codEstudiante"
                                    placeholder="0000000" onchange="alumno();"><span id="errmsg"></span>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingrese nombre del estudiante">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fechaNacimiento">Fecha</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fecha"
                                    placeholder="00/00/0000">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pohoralhoraiza">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"><span
                                    id="errmsg"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="causa">Tipo de muerte</label>
                                <!-- <textarea name="causa" id="causa" class="form-control" cols="80"></textarea> -->
                                <select name="causa" id="causa" class="form-control">
                                    <option value="Accidente">Accidente</option>
                                    <option value="Suicidio">Suicidio</option>
                                    <option value="Asesinato">Asesinato</option>
                                    <option value="Causas Naturales">Causas Naturales</option>
                                    <option value="Enfermedad Comun">Enfermedad Com&uacute;n</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idioma">Idioma</label>
                                <input type="text" name="Idioma" id="Idioma" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idioma">M&eacute;dico que atendi&oacute;</label>
                                <input type="text" name="Medico" id="Medico" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <input type="hidden" name="causa_id" id="causa_id">
                            <div class="form-group col-md-12" id="descripcion_causa" style="display: none;">
                                <label for="descripcion_causa">Causa de muerte</label>
                                <input type="text" class="form-control" id="descripcion_causa_input"
                                    name="descripcion_causa">
                            </div>
                            <div class="form-group col-md-10" id="selectcol">

                                <label for="descripcion_causa">Causa de muerte</label>
                                <select name="descripcion_causa_select" id="descripcion_causa" class="selectpicker form-control"
                                    data-live-search="true">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="departamento">Departamento</label>
                                <input type="text" name="departamento" id="departamento" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="municipio">Municipio</label>
                                <input type="text" name="municipio" id="municipio" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="padre">Padre</label>
                                <input type="text" name="padre" id="padre" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="TelPadre">Tel. Padre</label>
                                <input type="text" name="TelPadre" id="TelPadre" maxlength="8" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="madre">Madre</label>
                                <input type="text" name="madre" id="madre" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="TelMadre">Tel. Madre</label>
                                <input type="text" name="TelMadre" id="TelMadre" maxlength="8" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="Tutor">Tutor</label>
                            <input type="text" name="Tutor" id="Tutor" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="TelTutor">Tel&eacute;fono Tutor</label>
                                <input type="text" name="TelTutor" id="TelTutor" maxlength="8" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="DPITutor">DPI Tutor</label>
                                <input type="text" name="DPITutor" id="DPITutor" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ParentescoTutor">Parentesco Tutor</label>
                                <input type="text" name="ParentescoTutor" id="ParentescoTutor" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="EmailTutor">Email Tutor</label>
                                <input type="text" name="EmailTutor" id="EmailTutor" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="ComentarioTutor">Comentarios</label>
                                <textarea id="ComentarioTutor" name="ComentarioTutor" class="form-control"
                                    cols="80"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="lugar">Lugar de los hechos</label>
                            <input type="text" name="lugar" id="lugar" class="form-control">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="NombreReporta">Nombre de quien reporta</label>
                            <input type="text" name="NombreReporta" id="NombreReporta" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="RelacionReporta">Relaci&oacute;n</label>
                                <input type="text" name="RelacionReporta" id="RelacionReporta" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="TelReporta">Tel&eacute;fono</label>
                                <input type="text" name="TelReporta" id="TelReporta" maxlength="8" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.fn.selectpicker.Constructor.BootstrapVersion = '4';

</script>
<script type="text/javascript">
    function alumno() {
        var codigo = $('#codEstudiante').val();
        if (codigo == 1) {
            $('#nombre').val('Jefferson Morataya');
        } else if (codigo == 2) {
            $('#nombre').val('Luis Medina');
        } else if (codigo == 3) {
            $('#nombre').val('Carlos Sagastume');
        } else if (codigo == 4) {
            $('#nombre').val('Patricia Morales');
        } else if (codigo == 5) {
            $('#nombre').val('Ana Lucía Robles');
        } else if (codigo == 6) {
            $('#nombre').val('Juan Antonio Palma');
        } else if (codigo == 7) {
            $('#nombre').val('Rodrigo Oliva');
        } else if (codigo == 8) {
            $('#nombre').val('Silvia Arévalo');
        } else if (codigo == 9) {
            $('#nombre').val('Rosa Mendoza');
        }
    }

    // Restricts input for the given textbox to the given inputFilter function.
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

</script>
@endsection
