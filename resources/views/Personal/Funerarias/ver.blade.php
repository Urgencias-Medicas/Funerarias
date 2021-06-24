@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 class="my-3">Funerarias</h3>
            <a class="btn btn-primary mb-3 float-right" href="/Personal/CrearFuneraria">Crear funeraria</a>
            <div class="table-responsive">
                <table id="table" class="table table-light table-striped border rounded mb-5">
                    <thead class="">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Categor&iacute;a</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($Funerarias as $funeraria)
                        <tr>
                            <td>{{$funeraria->name}}</td>
                            <td>{{$funeraria->email}}</td>
                            <td>{{$funeraria->tipo_funeraria}}</td>
                            <td>
                            @if($funeraria->activo == 'No')
                            <span style="color:orange;">No Activa</span>
                            @else
                            <span style="color:green;">Activa</span>
                            @endif
                            </td>
                            <td>
                            @if($funeraria->activo == 'No')
                                <a href="/Personal/Funeraria/{{$funeraria->id}}/ver"><button class="btn btn-link">Ver más</button></a>
                            @else
                                <a href="/Personal/Funeraria/{{$funeraria->id}}/ver"><button class="btn btn-link">Ver más</button></a>
                            @endif
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
        },
        "aaSorting:" []
    });
});
</script>
@endsection
