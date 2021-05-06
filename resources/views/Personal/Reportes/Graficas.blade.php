@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<div class="container">
    <div class="row mb-1 justify-content-center">
        <div class="col-md-12">
            <h3>Tablero</h3>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label>Funeraria</label>
                </div>
                <div class="col-md-3">
                    <label>Departamento</label>
                </div>
                <div class="col-md-2">
                    <label for="fechaInicio">Fecha de Inicio</label>
                </div>
                <div class="col-md-2">
                    <label for="fechaFin">Fecha de Final</label>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select form-control" >
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-control">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="input-group ">
                        <input type="date" id="fechaInicio" class="form-control" value="{{ isset($Fecha_Inicio) ? $Fecha_Inicio : '' }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group ">
                        <input type="date" id="fechaFin" class="form-control" value="{{ isset($Fecha_Fin) ? $Fecha_Fin : '' }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-info btn-block " onClick="Filtrar();">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 justify-content-center text-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Funerarias</h5>
                    <p class="display-4">1234</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Servicios Atendidos</h5>
                    <p class="display-4">154</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Edad promedio</h5>
                    <p class="display-4">11</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Costos</h5>
                    <p class="display-4">1234</p>
                    <small>Miles de quetzales</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 justify-content-center text-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Departamentos</h5>
                    <small>Servicios por departamento</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Causas de muertes</h5>
                    <canvas id="TiposMuerte"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h5>Pendientes por pagar</h5>
                    <p class="display-4">1234</p>
                    <small>Miles de quetzales</small>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Servicios pagados</h5>
                    <p class="display-4">1234</p>
                    <small>Miles de quetzales</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 justify-content-center text-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Valoración promedio</h5>
                    <p class="display-4">1234</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Funerarias por categoria</h5>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Porcentaje de satisfacción</h5>
                    <p class="display-4">98%</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Aseguradoras</h5>
                    <p class="display-4">1234</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-deck mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Servicios atendidos
                        </h4>
                        <canvas id="Servicios"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-deck mt-4">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">
                            Promedio de evaluación del servicio
                        </h4>
                        <canvas id="Evaluacion"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function Filtrar() {
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
            window.location.href = '/Personal/Reportes/Graficas/' + fechainicio + '/0';
        } else if (fechainicio != '' && fechafin != '') {
            window.location.href = '/Personal/Reportes/Graficas/' + fechainicio + '/' + fechafin;
        }
    }

</script>
<!-- Conteo de servicios -->
<script>
var ctx = document.getElementById('Servicios').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: {!! $Funerarias !!},
        datasets: [{
            label: 'Servicios atendidos',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: {!! $Conteo_Servicios !!}
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<!-- Promedio de evaluaciones -->
<script>
var ctx = document.getElementById('Evaluacion').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: {!! $Funerarias !!},
        datasets: [{
            label: 'Promedio de evaluación',
            backgroundColor: 'rgba(153, 102, 255, 1)',
            borderColor: 'rgba(153, 102, 255, 1)',
            data: {!! $Promedio_Funerarias !!}
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<!-- Tipos de muerte -->
<script>
var ctx = document.getElementById('TiposMuerte').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: {!! $Muertes !!},
        datasets: [{
            label: 'Tipos de muerte',
            backgroundColor: 'rgba(54, 162, 235, 1)',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: {!! $Conteo_Muertes !!}
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection
