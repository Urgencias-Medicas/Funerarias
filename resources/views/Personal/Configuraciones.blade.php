@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tipo de cambio</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="https://www.banguat.gob.gt/cambio/" target="_blank" class="btn btn-info">Verificar en BANGUAT</a>
                        </div>
                    </div>
                    <br>
                    <form method="POST" action="/Personal/configuraciones/guardar">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12 offset-md-4">
                                <input id="tasa_cambio" type="text" class="form-control" style="height: 150px; width: 210px; font-size: 50px; text-align: center;" name="tasa_cambio" value="{{$Tasa_Cambio}}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
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
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 100; //Input fields increment limitation
    var addButton = $('#add_button'); //Add button selector
    var removeButton = $('#remove_button');
    var wrapper = $('.field_wrapper'); //Input field wrapper
    //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        var contador = $('#contadorCampos').val();
        var total = parseInt(contador) + 1;
        $('#contadorCampos').val(total);
        var fieldHTML = '<div class="form-group row" id="divcampo_'+total+'">\
                                <label for="campos" class="col-md-4 col-form-label text-md-right">Nombre del nuevo campo</label>\
                                <div class="col-md-6">\
                                    <input id="campo_'+total+'" type="text" class="form-control" name="campo_'+total+'" value="" required>\
                                </div>\
                            </div>'
        $(wrapper).append(fieldHTML); //Add field html
    });
    
    //Once remove button is clicked
    $(removeButton).click(function(){
        var contador = $('#contadorCampos').val();
        var total = parseInt(contador) - 1;
        $('#contadorCampos').val(total);
        $('#divcampo_'+contador).remove();
        console.log('test');
    })
    /*$(wrapper).on('click', '#remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        var contador = $('#contadorCampos').val();
        var total = parseInt(contador) - 1;
        $('#contadorCampos').val(total);
        x--; //Decrement field counter
    });*/
});
</script>
@endsection
