@extends('layouts.app')

@section('content')
@if(!empty($alerta))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$alerta}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 class="mt-4">Usuarios</h3>
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>E-Mail</th>
                                <th>Funeraria</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $user)
                            <tr id="user-{{$user->id}}">
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->nombre_funeraria}}</td>
                                <td><a href="/Personal/editarUsuario/{{$user->id}}"><button class="btn btn-link">Editar</button></a>
                                <button class="btn btn-link" onclick="eliminar({{$user->id}})">Eliminar</button>
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
    var table = $('#table').DataTable();
});

function eliminar(id){
    $.ajax({
            url: "/Personal/eliminarUsuario/" + id,
            type: 'get',
            success: function (response) {
                $('#user-'+id).remove();
            }
        });
}
</script>
@endsection