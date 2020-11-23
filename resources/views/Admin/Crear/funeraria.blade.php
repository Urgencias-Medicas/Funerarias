@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar funeraria</div>

                <div class="card-body">
                    <form method="POST" action="/Personal/nuevaFuneraria">
                        @csrf

                        <input id="nombre" type="hidden" class="form-control @error('name') is-invalid @enderror"
                            name="nombre">

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Funeraria</label>
                            <div class="col-md-6">
                                <select id="select-funerarias" name="funeraria" class="form-control"
                                    onChange="nombreFuneraria();" required>
                                    <option>-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="mail" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="mail" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono</label>

                            <div class="col-md-6">
                                <input id="telefono" maxlength="8" type="text" class="form-control" name="telefono" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="MontoBase" class="col-md-4 col-form-label text-md-right">Monto Base</label>

                            <div class="col-md-6">
                                <input id="MontoBase" type="text" class="form-control" name="MontoBase" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
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
    $(document).ready(function () {
        $.ajax({
            url: "https://umbd.excess.software/api/getFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '<option>-- Seleccione --</option>';

                for (var j = 0; j < len; j++) {
                    html += '<option value="' + response[j].id + '">' + response[j].funeraria +
                        '</option>';
                }
                $('#select-funerarias').html(html);
            }
        });
    });

    function nombreFuneraria() {
        var val_select = $('#select-funerarias option:selected').text();
        console.log(val_select);
        $('#nombre').val(val_select);
    }

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
