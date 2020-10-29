@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cambiar Correo</div>

                <div class="card-body">
                    <form method="POST" action="/mail/guardarCambio">
                        @csrf

                        <div class="form-group row">
                            <label for="mail" class="col-md-4 col-form-label text-md-right">Nuevo Correo</label>

                            <div class="col-md-6">
                                <input id="mail" type="email" class="form-control" name="mail"
                                    value="" onChange="verifyMail();" required autocomplete="off"
                                    autofocus>
                                <small id="MailAbout" class="form-text" style="color: red;"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password" class="col-md-4 col-form-label text-md-right">Contrase&nacute;a</label>

                            <div class="col-md-6">
                                <input id="Password" type="password" class="form-control" name="Password"
                                    onChange="verifyPassword();" aria-describedby="oldPassAbout">
                                <small id="PassAbout" class="form-text" style="color: red;"></small>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btn-register">
                                    Cambiar
                                </button>
                            </div>
                        </div>
                    </form>
                    <input type="hidden" id="PassVerify">
                    <input type="hidden" id="MailVerify">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function verifyPassword() {
        var password = $('#Password').val();
        $.ajax({
            type: "GET",
            url: "/password/verificar/" + password,
            success: function (response) {
                if (response != true) {
                    $('#PassAbout').html('Contraseña incorrecta');
                    $('#PassVerify').val('false');
                    verify();
                } else {
                    $('#PassAbout').html('');
                    $('#PassVerify').val('true');
                    verify();
                }
            }
        });
    }

    function verifyMail() {
        var mail = $('#mail').val();
        $.ajax({
            type: "GET",
            url: "/mail/verificar/" + mail,
            success: function (response) {
                if (response != true) {
                    $('#MailAbout').html('Este Mail ya se encuentra en uso');
                    $('#MailVerify').val('false');
                    verify();
                } else {
                    $('#MailAbout').html('');
                    $('#MailVerify').val('true');
                    verify();
                }
            }
        });
    }

    function verify() {
        var PassVerify = $('#PassVerify').val();
        var MailVerify = $('#MailVerify').val();
        if (PassVerify == 'true' && MailVerify == 'true') {
            $('#btn-register').attr('disabled', false);
        } else {
            $('#btn-register').attr('disabled', true);
        }
    }

</script>
@endsection
