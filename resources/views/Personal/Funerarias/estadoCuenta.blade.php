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
        <div class="row mt-4">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        
                        <label for="fechaInicio">Fecha de Inicio</label>
                        <div class="input-group ">
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="{{isset($FechaInicio) ? $FechaInicio : ''}}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-5">
                        
                        <label for="fechaFin">Fecha de Final</label>
                        <div class="input-group ">
                            <input type="date" name="fechaFin" id="fechaFin" class="form-control" value="{{isset($FechaFin) ? $FechaFin : ''}}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        <button type="button" onclick="window.open('/Personal/estadoCuentaFunerarias/' + $('#fechaInicio').val() + '/' + $('#fechaFin').val(),'_self');" class="btn btn-block btn-info" style="background: #193364;color:white">Aplicar</button>
                    </div>
                </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">        
            <div class="table-responsive">
                <table id="table" class="table table-light table-striped border rounded mb-5">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Costo</th>
                            <th>Pagado</th>
                            <th>Pendiente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Funerarias as $funeraria)
                        <tr id="funeraria-{{$funeraria->id}}">
                            <td>{{$funeraria->id}}</td>
                            <td><a href="#" onclick="{{ isset($FechaInicio) ? 'verDetalle('.$funeraria->id.', \''.$FechaInicio.'\', \''.$FechaFin.'\')' : 'verDetalle('.$funeraria->id.')' }}" data-toggle="modal" data-target="#detalleModal">{{$funeraria->funeraria}}</a></td>
                            <td>{{$funeraria->estado}}</td>
                            <td>Q{{$funeraria->costo}}</td>
                            <td>Q{{$funeraria->pagado}}</td>
                            <td>Q{{$funeraria->pendiente}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table-detalle" class="table table-light table-striped border rounded mb-5">
                        <thead>
                            <tr>
                                <th>Caso</th>
                                <th>Costo</th>
                                <th>Pagado</th>
                                <th>Pendiente</th>
                                <th>Moneda</th>
                            </tr>
                        </thead>
                        <tbody id="body-detalles">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    var table_detalle = $('#table-detalle').DataTable();

});

function verDetalle(id, fechainicio = null, fechafin = null){

    var new_url = '';

    if(fechainicio != null && fechafin != null){
        new_url = "/Personal/detalleCuentaFuneraria/" + id + "/" + fechainicio + "/" + fechafin;
    }else{
        new_url = "/Personal/detalleCuentaFuneraria/" + id;
    }

    $.ajax({
            url: new_url,
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                for (let i = 0; i < len; i++) {
                    html += '<tr>\
                            <td><a href="/Casos/'+response[i].id+'/ver" target="_blank">Caso #'+response[i].id+'</a></td>\
                            <td>'+response[i].Costo+'</td>\
                            <td>'+response[i].Pagado+'</td>\
                            <td>'+response[i].Pendiente+'</td>\
                            <td>'+response[i].Moneda+'</td>\
                        </tr>';
                }
                $('#table-detalle').dataTable().fnDestroy();
                $('#body-detalles').html(html);
                $('#table-detalle').dataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Sin registros",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)"
        }
    });
            }
    });
}
</script>
@endsection