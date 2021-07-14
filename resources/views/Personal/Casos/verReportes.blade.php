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
        <div class="col-md-12">
        <h3 class="my-3">Reportes</h3>
        <div class="row mt-4">
                
                <div class="col">
                    <label for="fechaInicio">Fecha de Inicio</label>
                    <div class="input-group ">
                        <input type="date" id="fechaInicio" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="fechaFin">Fecha de Final</label>
                    <div class="input-group ">
                        <input type="date" id="fechaFin" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="aseguradora">&nbsp;</label>
                    <button class="btn btn-primary btn-block" onclick="filtrar();">Filtrar</button>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="table" class="table table-light table-striped border rounded mb-5 text-center">
                    <thead>
                        <tr>
                            <th>Caso</th>
                            <th>Fecha</th>
                            <th>Causa</th>
                            <th>Ver Caso</th>
                            <th>ver Reporte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Reportes as $reporte)
                        <tr>
                            <td><b>#{{$reporte->caso}}</b></td>
                            <td>{{date('Y/m/d', strtotime($reporte->fecha))}}</td>
                            <td>{{$reporte->causa}}</td>
                            <td>
                                <a href="/Casos/{{$reporte->caso}}/ver" class="btn btn-outline-info btn-block">Ir</a>
                            </td>
                            <td>
                                <!--@php
                                    $reporte->ruta = str_replace('/images/reportes/', '', $reporte->ruta);
                                @endphp
                                <a class="btn btn-outline-info btn-block" onclick="descargar({{$reporte->caso}}, '{{$reporte->ruta}}', {{json_encode($reporte->descargables_id)}})">Ver</a>-->
                                <a href="/Casos/{{$reporte->caso}}/reportes/generar" class="btn btn-outline-info btn-block" target="_blank">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function () {
    $.noConflict();
 
    var table = $('#table').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Sin registros",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar: "
        }
    });
    
});

function download(url, filename) {
fetch(url).then(function(t) {
    return t.blob().then((b)=>{
        var a = document.createElement("a");
        a.href = URL.createObjectURL(b);
        a.setAttribute("download", filename);
        a.click();
    }
    );
});
}

function descargar(caso, reporte, documentos) {

        console.log(documentos);

        download("/images/reportes/"+reporte,reporte);

        for (i = 0; i < documentos.length; ++i) {
            console.log(documentos[i]);
            download("/images/Caso"+caso+'-'+documentos[i],documentos[i]);
            //document.getElementById("descargable-"+documentos[i]).click();
        };

        //document.querySelector(".reporte-caso-"+caso).click();
    }

function filtrar(){
    var fechainicio = $('#fechaInicio').val();
    var fechafin = $('#fechaFin').val();
    var fechainicio_validar = new Date($('#fechaInicio').val());
    var fechafin_validar = new Date($('#fechaFin').val());

    if (fechainicio == '' && fechafin == '') {
    alert('Por favor seleccione una fecha.');
    } else if (fechainicio == '') {
        alert('Por favor seleccione una fecha válida.');
    } else if (fechafin_validar <= fechainicio_validar) {
        alert('Por favor seleccione una fecha válida.');
    } else if (fechafin == '' && fechainicio != '') {
        window.location.replace('/Casos/reportes/' + fechainicio + '/0');
    } else if (fechainicio != '' && fechafin != '') {
        window.location.replace('/Casos/reportes/' + fechainicio + '/' + fechafin);
    }
} 
</script>
@endsection