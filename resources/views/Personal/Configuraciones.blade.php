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
                            <div class="field_wrapper">
                        @if(isset($Checks))
                            @php
                            $contadorChecks = 1
                            @endphp
                            @foreach(json_decode($Checks) as $check)
                                    <div class="form-group row" id="divcampo_{{$contadorChecks}}">
                                        <label for="campos" class="col-md-4 col-form-label text-md-right">Nombre del nuevo campo</label>

                                        <div class="col-md-6">
                                            <input id="campo_{{$contadorChecks}}" type="text" class="form-control" name="campo_{{$contadorChecks}}" value="{{$check->nombre}}" required>
                                        </div>
                                    </div>
                            @php
                            $contadorChecks = $contadorChecks + 1
                            @endphp
                            @endforeach
                        @else
                        
                            <div class="form-group row" id="divcampo_1">
                                <label for="campos" class="col-md-4 col-form-label text-md-right">Nombre del nuevo campo</label>

                                <div class="col-md-6">
                                    <input id="campo_1" type="text" class="form-control" name="campo_1" value="" required>
                                </div>
                            </div>
                        @endif
                        </div>
                        <input type="hidden" name="contadorCampos" id="contadorCampos" value="{{isset($Checks) ? $contadorChecks - 1: 1}}">
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-4">
                                <button type="button" id="add_button" class="btn btn-success">
                                    Agregar nuevo campo
                                </button>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <button type="button" id="remove_button" class="btn btn-danger">
                                    Remover campo
                                </button>
                            </div>
                        </div>
                        <hr>
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
