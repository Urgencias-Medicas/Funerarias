@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 class="mt-3">Casos</h3>
            <table id="table" class="table table-light table-striped border rounded mb-5">
                <thead>
                    <tr>
                        <th scope="col">Caso #</th>
                        <th scope="col">Estudiante</th>
                        <th scope="col">Fecha y Hora</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Casos as $caso)
                    <tr>
                        <td>{{$caso->id}}</td>
                        <td>{{$caso->Nombre}}</td>
                        <td>{{date('m-d-Y', strtotime($caso->Fecha))}} - {{date('G:i', strtotime($caso->Hora))}}</td>
                        <td>{{$caso->Departamento}}</td>
                        <td>
                            @if($caso->Estatus == 'Abierto')
                                <span style="color:orange;"><b>{{$caso->Estatus}}</b></span>
                            @elseif($caso->Estatus == 'Asignado')
                                <span style="color:green"><b>{{$caso->Estatus}}</b></span>
                            @elseif($caso->Estatus == 'Cerrado')
                                <span style="color:gray"><b>{{$caso->Estatus}}</b></span>
                            @endif
                        </td>
                        <td>
                            <a href="/Funerarias/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Ver más</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $.noConflict();
    var table = $('#table').DataTable(
        {
            "order": [
                [0, "desc"]
            ],
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
