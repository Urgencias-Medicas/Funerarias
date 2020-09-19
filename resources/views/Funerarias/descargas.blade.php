@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <h1>Descargas</h1>
                    <hr>
                    <ul class="list-group">
                        @foreach($Archivos as $archivo)
                        <div class="list-group">
                            <a href="/images/requeridos/{{basename($archivo)}}" class="list-group-item list-group-item-action" download>
                            {{basename($archivo)}}
                            </a>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
