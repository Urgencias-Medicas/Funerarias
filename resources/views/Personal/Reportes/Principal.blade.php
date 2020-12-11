@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Reportes</h3>
            <!--<div class="row">
                <div class="col-md-12 text-center">
                    <label for="fechaInicio"><b>Fecha Inicio</b></label>
                    <input type="date" id="fechaInicio">
                    <label for="fechaFin"><b>Fecha Fin</b></label>
                    <input type="date" id="fechaFin">
                </div>
            </div>-->
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
            </div>
            <div class="card-deck mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a onclick="reporte('Edades');">
                                Edades de muertes
                            </a></h4>
                        <p class="card-text">Reporte que lista edades de fallecidos dentro de un parametro de fechas
                            escogidas.</p>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <span id="export" class="btn btn-success btn-sm" onclick="reporte('EdadesCSV');">Generar
                                    CSV</span>
                                <span id="export" class="btn btn-success btn-sm" onclick="reporte('EdadesExcel');">Generar
                                    Excel</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> <a onclick="reporte('Causas');">
                                Causas de muertes
                            </a></h4>
                        <p class="card-text">Reporte que lista causas de muertes dentro de un parametro de fechas
                            escogidas.</p>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <span id="export" class="btn btn-success btn-sm" onclick="reporte('CausasCSV');">Generar
                                    CSV</span>
                                <span id="export" class="btn btn-success btn-sm" onclick="reporte('CausasExcel');">Generar
                                    Excel</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a onclick="reporte('Lugares');">
                                Lugares de muertes
                            </a></h4>
                        <p class="card-text">Reporte que lista lugares de muerte dentro de un parametro de fechas
                            escogidas.</p>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <span id="export" class="btn btn-success btn-sm"
                                    onclick="reporte('LugaresCSV');">Generar
                                    CSV</span>
                                <span id="export" class="btn btn-success btn-sm"
                                onclick="reporte('LugaresExcel');">Generar
                                Excel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card-deck mt-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a onclick="reporte('General');">
                                General
                            </a></h4>
                        <p class="card-text">Reporte general.</p>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <span id="export" class="btn btn-success btn-sm" onclick="reporte('GeneralCSV');">CSV
                                    General</span>
                                <span id="export" class="btn btn-success btn-sm" onclick="reporte('ExcelGeneral');">Excel
                                    General</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function reporte(reportar) {
        var fechainicio = $('#fechaInicio').val();
        var fechafin = $('#fechaFin').val();
        var fechainicio_validar = new Date($('#fechaInicio').val());
        var fechafin_validar = new Date($('#fechaFin').val());

        if (reportar == 'GeneralCSV') {
            if (fechainicio == '' && fechafin == '') {
                alert('Por favor seleccione una fecha.');
            } else if (fechainicio == '') {
                alert('Por favor seleccione una fecha válida.');
            } else if (fechafin_validar <= fechainicio_validar) {
                alert('Por favor seleccione una fecha válida.');
            } else if (fechafin == '' && fechainicio != '') {
                window.open('/Personal/Reportes/GeneralCSV/' + fechainicio + '/0');
                window.open('/Personal/Reportes/CSVConteoCausas/' + fechainicio + '/0');
                window.open('/Personal/Reportes/CSVConteoFunerarias/' + fechainicio + '/0');
                window.open('/Personal/Reportes/CSVCausasDeptos/' + fechainicio + '/0');
            } else if (fechainicio != '' && fechafin != '') {
                window.open('/Personal/Reportes/GeneralCSV/' + fechainicio + '/' + fechafin);
                window.open('/Personal/Reportes/CSVConteoCausas/' + fechainicio + '/' + fechafin);
                window.open('/Personal/Reportes/CSVConteoFunerarias/' + fechainicio + '/' + fechafin);
                window.open('/Personal/Reportes/CSVCausasDeptos/' + fechainicio + '/' + fechafin);
            }
        } else if(reportar == 'ExcelGeneral'){
            if (fechainicio == '' && fechafin == '') {
                alert('Por favor seleccione una fecha.');
            } else if (fechainicio == '') {
                alert('Por favor seleccione una fecha válida.');
            } else if (fechafin_validar <= fechainicio_validar) {
                alert('Por favor seleccione una fecha válida.');
            } else if (fechafin == '' && fechainicio != '') {
                window.open('/Personal/Reportes/ExcelGeneral/' + fechainicio + '/0');
                window.open('/Personal/Reportes/ExcelConteoCausas/' + fechainicio + '/0');
                window.open('/Personal/Reportes/ExcelConteoFunerarias/' + fechainicio + '/0');
                window.open('/Personal/Reportes/ExcelCausasDeptos/' + fechainicio + '/0');
            } else if (fechainicio != '' && fechafin != '') {
                window.open('/Personal/Reportes/ExcelGeneral/' + fechainicio + '/' + fechafin);
                window.open('/Personal/Reportes/ExcelConteoCausas/' + fechainicio + '/' + fechafin);
                window.open('/Personal/Reportes/ExcelConteoFunerarias/' + fechainicio + '/' + fechafin);
                window.open('/Personal/Reportes/ExcelCausasDeptos/' + fechainicio + '/' + fechafin);
            }
        } else {
            if (fechainicio == '' && fechafin == '') {
                alert('Por favor seleccione una fecha.');
            } else if (fechainicio == '') {
                alert('Por favor seleccione una fecha válida.');
            } else if (fechafin_validar <= fechainicio_validar) {
                alert('Por favor seleccione una fecha válida.');
            } else if (fechafin == '' && fechainicio != '') {
                window.open('/Personal/Reportes/' + reportar + '/' + fechainicio + '/0');
            } else if (fechainicio != '' && fechafin != '') {
                window.open('/Personal/Reportes/' + reportar + '/' + fechainicio + '/' + fechafin);
            }
        }
    }

</script>
@endsection
