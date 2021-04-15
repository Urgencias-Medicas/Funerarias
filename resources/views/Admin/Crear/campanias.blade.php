@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar funeraria</div>

                <div class="card-body">
                    <form method="POST" action="/Personal/Campanias/guardar">
                        @csrf

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">Campaña</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="Nombre" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Código. Aseguradora</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="CodigoAseguradora" name="CodigoAseguradora" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Nombre Aseguradora</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="NombreAseguradora" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Moneda</label>
                            <div class="col-md-6">
                                <select name="Moneda" class="form-control">
                                    <option value="GTQ">GTQ</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>

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
        setInputFilter(document.getElementById("MontoBase"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });
        setInputFilter(document.getElementById("CodigoAseguradora"), function (value) {
            return /^\d*\.?\d*$/.test(value);
        });

    });
</script>
@endsection
