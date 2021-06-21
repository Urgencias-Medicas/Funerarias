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
            <h3 class="my-3">Campañas</h3>
            <a class="btn btn-primary float-right mb-3" href="/Personal/Campanias/crear">Crear campaña</a>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Diminutivo</th>
                                <th>Aseguradora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Campanias as $Campania)
                            <tr id="aseguradora-{{$Campania->id}}">
                                <td>{{$Campania->id}}</td>
                                <td>{{$Campania->Nombre}}</td>
                                <td>{{$Campania->Diminutivo}}</td>
                                <td>{{$Campania->Aseguradora.' - '.$Campania->Nombre_Aseguradora}}</td>
                                <td>
                                <a href="/Personal/Campanias/ver/{{$Campania->id}}"><button class="btn btn-link">Editar</button></a>
                                <a href="/Personal/Campanias/eliminar/{{$Campania->id}}"><button class="btn btn-link">Eliminar</button></a>
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
</script>
@endsection