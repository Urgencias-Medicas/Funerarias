@extends('layouts.app')

@section('content')
<!-- Latest compiled and minified JavaScript -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cambiar contrase&nacute;a</div>

                <div class="card-body">
                    <form method="POST" action="/password/guardarCambio" enctype="multipart/form-data">
                        @csrf
                        <div id="principal">
                            <div class="form-group row">
                                <label for="oldPassword" class="col-md-4 col-form-label text-md-right">Contrase&nacute;a actual</label>

                                <div class="col-md-6">
                                    <input id="oldPassword" type="password" class="form-control" name="oldPassword" onChange="verifyPassword('old');" aria-describedby="oldPassAbout">
                                    <small id="oldPassAbout" class="form-text" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newPassword" class="col-md-4 col-form-label text-md-right">Nueva contrase&nacute;a</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control" name="newPassword" onChange="verifyPassword('confirm');">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirmPassword" class="col-md-4 col-form-label text-md-right">Confirmar contrase&nacute;a</label>

                                <div class="col-md-6">
                                    <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" onChange="verifyPassword('confirm');" aria-describedby="confirmPassAbout">
                                    <small id="confirmPassAbout" class="form-text" style="color: red;"></small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldPassVerify">
                        <input type="hidden" id="confirmPass">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btn-register" disabled>
                                    Save
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
function verifyPassword(type){
    if(type == "old"){
        var password = $('#oldPassword').val();
        $.ajax({
            type: "GET",
            url: "/password/verificar/"+password,
            success: function(response){
                if(response != true){
                    $('#oldPassAbout').html('Incorrect password');
                    $('#oldPassVerify').val('false');
                    verify();
                }else{
                    $('#oldPassAbout').html('');
                    $('#oldPassVerify').val('true');
                    verify();
                }
                console.log(response);
            }
        });
    }else if(type == "confirm"){
        var password = $('#newPassword').val();
        var confirm = $('#confirmPassword').val();
        if(confirm == password){
            $('#confirmPassAbout').html('');
            $('#confirmPass').val('true');
            verify();
        }else{
            $('#confirmPassAbout').html('Passwords not match.');
            $('#confirmPass').val('false');
            verify();
        }
    }

}

function verify(){
    var oldPassVerify = $('#oldPassVerify').val();
    var confirmPass = $('#confirmPass').val();
    if(oldPassVerify == 'true' && confirmPass == 'true'){
        $('#btn-register').attr('disabled', false);
    }else{
        $('#btn-register').attr('disabled', true);
    }
}
</script>
@endsection
