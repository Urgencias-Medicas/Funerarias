@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" class="btn btn-link"><a href="/Personal/verFunerarias">
                    < Atrás</a> </button> <div class="card">
                        <div class="card-header">Información</div>

                        <div class="card-body align-items-center justify-content-center">
                            <form action="/Personal/Funeraria/{{$Funeraria->id}}/{{$Detalle->id}}/guardar"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre Funeraria" value="{{$Funeraria->Nombre}}" readonly>
                                </div>
                                <div class="form-group ">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{$Funeraria->Email}}">
                                </div>
                                <div class="form-group ">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control"
                                        value="{{$Funeraria->Telefono}}" maxlength="8">
                                </div>
                                <div class="form-group ">
                                    <label for="MontoBase">Monto base</label>
                                    <input type="text" name="MontoBase" id="MontoBase" class="form-control"
                                        value="{{$Funeraria->Monto_Base}}">
                                </div>
                                <div class="form-group">
                                    <label for="activa">Activa</label>
                                    <select name="activo" id="activo" class="form-control">
                                        @if($Funeraria->activo == 'No')
                                        <option value="No" selected>No</option>
                                        <option value="Si">Si</option>
                                        @else
                                        <option value="Si" selected>Si</option>
                                        <option value="No">No</option>
                                        @endif
                                    </select>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            @if($Detalle->paso_uno == 'Si')
                                            <input type="checkbox" class="form-check-input" value="Hecho"
                                                name="paso_uno" checked>Paso 1 Completado
                                            @else
                                            <input type="checkbox" class="form-check-input" name="paso_uno"
                                                value="Hecho">Paso 1 Completado
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            @if($Detalle->paso_dos == 'Si')
                                            <input type="checkbox" class="form-check-input" value="Hecho"
                                                name="paso_dos" checked>Paso 2 Completado
                                            @else
                                            <input type="checkbox" class="form-check-input" name="paso_dos"
                                                value="Hecho">Paso 2 Completado
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            @if($Detalle->paso_tres == 'Si')
                                            <input type="checkbox" class="form-check-input" value="Hecho"
                                                name="paso_tres" checked>Paso 3 Completado
                                            @else
                                            <input type="checkbox" class="form-check-input" name="paso_tres"
                                                value="Hecho">Paso 3 Completado
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary float-right">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
// Restricts input for the given textbox to the given inputFilter function.
function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (
            event) {
            textbox.addEventListener(event, function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }

    $(document).ready(function () {
        setInputFilter(document.getElementById("telefono"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("MontoBase"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });

    });
</script>
@endsection
