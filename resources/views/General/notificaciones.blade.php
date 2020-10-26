@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h3 class="mt-3">Notificaciones</h3>
                   
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
@endsection
