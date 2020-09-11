@extends('layouts.app')

@section('content')
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
                                <input type="text" class="form-control" id="codEstudiante" name="codEstudiante" placeholder="0000000" onchange="alumno();"><span id="errmsg"></span>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del estudiante">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fechaNacimiento">Fecha</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fecha" placeholder="00/00/0000">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pohoralhoraiza">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"><span id="errmsg"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="causa">Causa</label>
                                <textarea name="causa" id="causa" class="form-control" cols="80"></textarea>
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
                                <label for="madre">Madre</label>
                                <input type="text" name="madre" id="madre" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lugar">Lugar de los hechos</label>
                            <input type="text" name="lugar" id="lugar" class="form-control">
                        </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function () {
  //called when key is pressed in textbox
  $("#poliza").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Solamente n&uacute;meros").show().fadeOut("slow");
               return false;
    }
   });
});

function alumno(){
    var codigo = $('#codEstudiante').val();
    if(codigo == 1){
        $('#nombre').val('Jefferson Morataya');
    }else if(codigo == 2){
        $('#nombre').val('Luis Medina');
    }else if(codigo == 3){
        $('#nombre').val('Carlos Sagastume');
    }else if(codigo == 4){
        $('#nombre').val('Patricia Morales');
    }else if(codigo == 5){
        $('#nombre').val('Ana Lucía Robles');
    }
}
</script>
@endsection

