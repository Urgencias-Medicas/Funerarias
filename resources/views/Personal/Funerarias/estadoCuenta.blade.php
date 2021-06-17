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
                            <td>{{$funeraria->funeraria}}</td>
                            <td>{{$funeraria->estado}}</td>
                            <td>{{$funeraria->costo}}</td>
                            <td>{{$funeraria->pagado}}</td>
                            <td>{{$funeraria->pendiente}}</td>
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
    var table = $('#table').DataTable();
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