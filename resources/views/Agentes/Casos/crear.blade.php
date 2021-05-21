@extends('layouts.app')

@section('content')
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
                                    placeholder="0000000" onchange="alumno();" required><span id="errmsg"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingrese nombre del estudiante" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Aseguradora">Cod. Aseguradora</label>
                                <input type="text" name="aseguradora" id="Aseguradora" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Nombre_Aseguradora">Nombre Aseguradora</label>
                                <input type="text" id="Nombre_Aseguradora" name="Nombre_Aseguradora" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="edad">Edad</label>
                                <input type="text" name="edad" id="edad" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fechaNacimiento">Fecha</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fecha"
                                    placeholder="00/00/0000">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pohoralhoraiza">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"><span
                                    id="errmsg"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="causa">Tipo de muerte</label>
                                <!-- <textarea name="causa" id="causa" class="form-control" cols="80"></textarea> -->
                                <select name="causa" id="causa" class="form-control" required>
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
                            <div class="form-group col-md-6" id="selectcol">

                                <label for="descripcion_causa_select">Causa de muerte</label>
                                <select name="descripcion_causa_select" id="descripcion_causa_select"
                                    class="form-control" placeholder="Causa de muerte" required>
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
                            <div class="form-group col-md-12">
                                <label for="causa_especifica">Descripcion de causa</label>
                                <input type="text" name="causa_especifica" id="causa_especifica" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="departamento">Departamento</label>
                                <select name="departamento" id="departamento" class="form-control" required
                                    onchange="makeSubmenu(this.value)">
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
                            <div class="form-group col-md-4">
                                <label for="municipio">Municipio</label>

                                <select name="municipio" id="municipio" class="form-control" required>
                                    <option>Seleccione un departamento primero.</option>
                                </select>
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
        setInputFilter(document.getElementById("DPITutor"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("TelReporta"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("edad"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });


    });

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
        search: true
    });

    function makeSubmenu(value) {
        var municipio = {!! $Json !!};

        if (value.length == 0) {
            $('#municipio').html = "<option></option>";
        } else {
            var munOptions = "";
            for (munId in municipio[value]) {
                munOptions += "<option value='"+municipio[value][munId]+"'>" + municipio[value][munId] + "</option>";
            }
            document.getElementById("municipio").innerHTML = munOptions;
        }
    }

    /*function getMunicipios() {
        var result = null;
        //$.ajax({
        //    url: "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json",
        //    type: 'get',
        //    dataType: 'JSON',
        //    success: function (response) {
        //        result = response;
        //    }
        //})
        //
        //console.log(result);
        $.getJSON(
            "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json",
            function (json) {
                result = json;
            });

        console.log(result);
        return result;
    }*/

</script>
@endsection
