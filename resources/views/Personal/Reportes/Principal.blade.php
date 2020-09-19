@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1>Generar Reportes</h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label for="fechaInicio"><b>Fecha Inicio</b></label>
                            <input type="date" id="fechaInicio">
                            <label for="fechaFin"><b>Fecha Fin</b></label>
                            <input type="date" id="fechaFin">
                        </div>
                    </div>
                    <br>
                    <ul class="list-group">
                        <div class="list-group">
                            <a onclick="reporte('Edades');" class="list-group-item list-group-item-action">
                            Edades de muertes
                            </a>
                        </div>
                        <div class="list-group">
                            <a onclick="reporte('Causas');" class="list-group-item list-group-item-action">
                            Causas de muertes
                            </a>
                        </div>
                        <div class="list-group">
                            <a onclick="reporte('Lugares');" class="list-group-item list-group-item-action">
                            Lugares de muertes
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function reporte(reportar){
        var fechainicio = $('#fechaInicio').val();
        var fechafin = $('#fechaFin').val();
        var fechainicio_validar = new Date($('#fechaInicio').val());
        var fechafin_validar = new Date($('#fechaFin').val());
        if(fechainicio == '' && fechafin == ''){
            alert('Por favor seleccione una fecha.');
        }else if(fechainicio == '') {
            alert('Por favor seleccione una fecha válida.');
        }else if(fechafin_validar <= fechainicio_validar) {
            alert('Por favor seleccione una fecha válida.');
        }else if(fechafin == '' && fechainicio != '') {
            window.open('/Personal/Reportes/'+reportar+'/'+fechainicio+'/0');
        }else if(fechainicio != '' && fechafin != ''){
            window.open('/Personal/Reportes/'+reportar+'/'+fechainicio+'/'+fechafin);
        }
    }
</script>
@endsection
