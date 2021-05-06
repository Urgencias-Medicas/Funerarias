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
            <h3 class="my-3">Usuarios</h3>
            <a class="btn btn-primary float-right mb-3" href="/Personal/CrearUsuario">Crear usuario</a>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>E-Mail</th>
                                <th>Rol</th>
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
                                <td>{{$user->rol}}</td>
                                <td>{{$user->funeraria}}</td>
                                <td>
                                @if($user->rol == 'Agente' || $user->rol == 'Personal')
                                    <a href="/Personal/editarUsuario/{{$user->id}}"><button class="btn btn-link">Editar</button></a>
                                @else
                                    <a href="/Personal/editarFuneraria/{{$user->id}}"><button class="btn btn-link">Editar</button></a>
                                @endif
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