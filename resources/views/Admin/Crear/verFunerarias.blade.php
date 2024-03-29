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
        <h3 class="my-3">Funerarias</h3>
            <div class="table-responsive">
                <table id="table" class="table table-light table-striped border rounded mb-5">
                    <thead>
                        <tr>
                            <!--<th>id</th>-->
                            <th>Nombre</th>
                            <th>Clasificaci&oacute;n</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Funerarias as $funeraria)
                        <tr id="funeraria-{{$funeraria->id}}">
                            <!--<td>{{$funeraria->id}}</td>-->
                            <td>{{$funeraria->funeraria}}</td>
                            <td>{{$funeraria->tipo}}</td>
                            <td>{{$funeraria->estado}}</td>
                            <td>
                            <a href="/Personal/editarFuneraria/{{$funeraria->id}}/{{$funeraria->funeraria}}"><button class="btn btn-link">Editar</button></a>
                            <!--<button class="btn btn-link" onclick="eliminar({{$funeraria->id}})">Eliminar</button>-->
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

function eliminar(id){
    $.ajax({
            url: "/Personal/eliminarFuneraria/" + id,
            type: 'get',
            success: function (response) {
                $('#funeraria-'+id).remove();
            }
        });
}
</script>
@endsection
