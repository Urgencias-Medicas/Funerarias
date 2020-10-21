@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h3 class="mt-3">Funerarias</h3>
                    <table class="table table-light table-striped border rounded mb-5">
                        <thead class="">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($Funerarias as $funeraria)
                            <tr>
                                <td>{{$funeraria->name}}</td>
                                <td>{{$funeraria->email}}</td>
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
@endsection
