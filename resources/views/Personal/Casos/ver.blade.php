@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content">
        <div class="col-md-12">

            <h3 class="my-3">Casos</h3>
            @role('Personal')<a class="btn btn-primary float-right mb-3" href="/Casos/vistaCrear">Crear Caso</a>@endrole
            <div class="table-responsive">
                <table id="table" class="table table-light table-striped border rounded mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Caso #</th>
                            <th scope="col">Correlativo</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col">Fecha y Hora</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Funeraria</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Casos as $caso)
                        <tr>
                            <td>{{$caso->id}}</td>
                            <td>{{$caso->Correlativo_Completo}}</td>
                            <td>{{$caso->Nombre}}</td>
                            <td>{{date('d/m/Y', strtotime($caso->Fecha))}} - {{date('h:i a', strtotime($caso->Hora))}}</td>
                            <td>{{$caso->Departamento}}</td>
                            <td>{{$caso->Funeraria}}</td>
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
                                @if($caso->Solicitud == 'Pendiente')
                                <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Abrir caso</button></a>
                                @elseif(!$caso->Funeraria)
                                <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Abrir caso</button></a>
                                @else
                                <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Abrir caso</button></a>
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
            "order": [
                [0, "desc"]
            ]
        });
    });

</script>
@endsection
