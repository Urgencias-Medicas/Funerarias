@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Casos</div>

                <div class="card-body align-items-center d-flex justify-content-center">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Estudiante</th>
                                <th scope="col">Fecha y Hora</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Funeraria</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($Casos as $caso)
                            <tr>
                                <td>{{$caso->Codigo}}</td>
                                <td>{{$caso->Nombre}}</td>
                                <td>{{date('m-d-Y', strtotime($caso->Fecha))}} - {{date('G:i', strtotime($caso->Hora))}}</td>
                                <td>{{$caso->Departamento}}</td>
                                <td>{{$caso->Funeraria}}</td>
                                <td>
                                    @if($caso->Estatus == 'Abierto')
                                        <span style="color:yellow;"><b>{{$caso->Estatus}}</b></span>
                                    @elseif($caso->Estatus == 'Asignado')
                                        <span style="color:green"><b>{{$caso->Estatus}}</b></span>
                                    @elseif($caso->Estatus == 'Cerrado')
                                        <span style="color:gray"><b>{{$caso->Estatus}}</b></span>
                                    @endif
                                </td>
                                <td>
                                @if(!$caso->Funeraria)
                                    <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-warning"><i class="fa fa-eye"></i></button></a>
                                @else
                                    <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
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
@endsection
