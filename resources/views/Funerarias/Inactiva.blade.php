@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Casos</div>

                <div class="card-body align-items-center d-flex justify-content-center">
                    
                <h1><b>Funeraria Inactiva</b></h1>
                </div>
            </div>
        </div>
    </div>
</div>

@if($Activa == 'Si')
    <script>
        $(document).ready(function(){
            window.location.href = '/Funerarias/Casos/ver';
        });
    </script>
@endif
@endsection
