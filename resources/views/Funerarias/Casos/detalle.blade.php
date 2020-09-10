@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Visualizar caso</div>

                <div class="card-body align-items-center justify-content-center">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Ingrese nombre del estudiante" value="{{$Caso->Nombre}}" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fechaNacimiento">Fecha</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fecha"
                                placeholder="00/00/0000" value="{{$Caso->Fecha}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pohoralhoraiza">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"
                                value="{{date('G:i', strtotime($Caso->Hora))}}" readonly><span id="errmsg"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="causa">Causa</label>
                            <textarea name="causa" id="causa" class="form-control" cols="80"
                                readonly>{{$Caso->Causa}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                value="{{$Caso->Direccion}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="departamento">Departamento</label>
                            <input type="text" name="departamento" id="departamento" class="form-control"
                                value="{{$Caso->Departamento}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="municipio">Municipio</label>
                            <input type="text" name="municipio" id="municipio" class="form-control"
                                value="{{$Caso->Municipio}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="padre">Padre</label>
                            <input type="text" name="padre" id="padre" class="form-control" value="{{$Caso->Padre}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="madre">Madre</label>
                            <input type="text" name="madre" id="madre" class="form-control" value="{{$Caso->Madre}}"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button class="btn btn-warning" onclick="window.location.href = '/Funerarias/Casos/ver';">Volver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
