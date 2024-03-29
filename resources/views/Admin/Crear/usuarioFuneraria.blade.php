@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar usuario</div>

                <div class="card-body">
                    <form method="POST" action="/Personal/nuevoUsuarioFuneraria">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="mail" type="email" class="form-control @error('email') is-invalid @enderror" name="mail" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Funeraria</label>
                            <div class="col-md-6">
                                <select id="select-funerarias" name="funeraria" class="form-control" onchange=" $('#submit_btn').removeAttr('disabled');" required>
                                    <option>-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submit_btn" class="btn btn-primary">
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
            url: "/verFunerarias",
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
</script>
@endsection
