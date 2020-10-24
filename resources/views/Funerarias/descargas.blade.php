@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-3">Descargas</h3>
                <div class="card-deck">
                @foreach($Archivos as $archivo)
                    <div class="card">
                        <div class="card-body">
                            <h4>Archivo:</h4>
                            <p>{{basename($archivo)}}</p>
                            <a href="/images/requeridos/{{basename($archivo)}}" class="" download>
                                Descargar
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>
        </div>
    </div>
</div>
@endsection
