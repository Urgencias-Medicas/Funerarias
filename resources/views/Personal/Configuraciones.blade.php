@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Configuraciones</div>

                <div class="card-body">
                    <form method="POST" action="/Personal/configuraciones/guardar">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Tasa de Cambio</label>

                            <div class="col-md-6">
                                <input id="tasa_cambio" type="text" class="form-control" name="tasa_cambio" value="{{$Tasa_Cambio}}" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h3><b>Pasos para funerarias</b></h3>
                            </div>
                        </div>
                        <!-- 

                            INSERTAR CÓDIGO PARA LOS CHECKS

                        -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
