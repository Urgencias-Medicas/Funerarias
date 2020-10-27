@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Usuarios</div>

                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>E-Mail</th>
                                <th>Rol</th>
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
                                <td>
                                    <button class="btn btn-danger" onclick="eliminar({{$user->id}})">Eliminar</button>
                                @if($user->rol == 'Agente' || $user->rol == 'Personal')
                                    <a href="/Personal/editarUsuario/{{$user->id}}"><button class="btn btn-primary">Editar</button></a>
                                @else
                                    <a href="/Personal/editarFuneraria/{{$user->id}}"><button class="btn btn-primary">Editar</button></a>
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