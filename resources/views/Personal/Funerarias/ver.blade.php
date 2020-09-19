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
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
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
                                    <a href="/Personal/Funeraria/{{$funeraria->id}}/ver"><button class="btn btn-warning">Ver <i class="fa fa-eye"></i></button></a>
                                @else
                                    <a href="/Personal/Funeraria/{{$funeraria->id}}/ver"><button class="btn btn-primary">Ver <i class="fa fa-eye"></i></button></a>
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
