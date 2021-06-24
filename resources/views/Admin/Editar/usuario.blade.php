@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar usuario</div>

                <div class="card-body">
                    <form method="POST" action="/Personal/guardarUsuario/{{$usuario->id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="nombre" value="{{$usuario->name}}" required autocomplete="name" autofocus>

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
                                <input id="mail" type="email" class="form-control @error('email') is-invalid @enderror" name="mail" value="{{ $usuario->email }}" onchange="verifyMail();" required autocomplete="email">
                                <small id="MailAbout" class="form-text" style="color: red;"></small>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Rol</label>
                            <div class="col-md-6">
                                <select name="tipo_usuario" class="form-control">
                                    <option>-- Seleccione --</option>
                                    <option value="Agente">Agente de Call Center</option>
                                    <option value="Personal">Personal interno</option>
                                </select>
                            </div>
                        </div>-->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submit_btn" class="btn btn-primary">
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
function verifyMail() {
        var mail = $('#mail').val();
        $.ajax({
            type: "GET",
            url: "/mail/verificar/" + mail,
            success: function (response) {
                if (response != true) {
                    $('#MailAbout').html('Este Mail ya se encuentra en uso');
                    $('#submit_btn').attr('disabled', true);
                } else {
                    $('#MailAbout').html('');
                    $('#submit_btn').attr('disabled', false);
                }
            }
        });
    }
</script>
@endsection
