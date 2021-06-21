@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 class="mt-3">Log de cambios</h3>
                    <table id="table" class="table table-light table-striped border rounded mb-5">
                        <thead class="">
                            <tr>
                                <th scope="col">Detalle</th>
                                <th scope="col">Id Usuario</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($Logs as $log)
                            <tr>
                                <td>{{$log->description}}</td>
                                <td>{{$log->causer_id}}</td>
                                <td>{{$log->user_name}}</td>
                                <td>{{$log->created_at}}</td>
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
