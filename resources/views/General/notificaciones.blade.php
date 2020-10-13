@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Notificaciones</div>

                <div class="card-body align-items-center d-flex justify-content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group">
                                    @foreach($Notificaciones As $Notificacion)
                                    <li class="list-group-item">{{$Notificacion->contenido}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
