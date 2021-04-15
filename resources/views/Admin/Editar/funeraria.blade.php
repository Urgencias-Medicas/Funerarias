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
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" class="form-control" id="departamento" name="departamento"
                                        placeholder="Nombre Funeraria" value="{{$Funeraria->Departamento}}" readonly>
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
                                <!--<div class="form-group ">
                                    <label for="MontoBase">Monto base</label>
                                    <input type="text" name="MontoBase" id="MontoBase" class="form-control"
                                        value="{{$Funeraria->Monto_Base}}">
                                </div>-->
                                <div class="form-group">
                                    <label for="selectCampaña">Campaña</label>
                                    <select name="selectCampaña" id="selectCampaña" class="form-control">
                                        <option>-- Seleccione campaña --</option>
                                        @foreach($Campanias as $campania)
                                            <option value="{{$campania->id}}">{{$campania->Nombre.', '.$campania->Nombre_Aseguradora. ' ('.$campania->Moneda.')'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <button type="button" class="btn btn-success" onClick="agregarCampania($('#selectCampaña').val(), $('#selectCampaña option:selected').text())"><i class="fa fa-plus"
                                    aria-hidden="true"></i> Agregar campaña</button>
                                    </div>
                                </div>
                                <hr>
                                <div id="campanias">
                                    @if($Funeraria->Campanias)
                                        @foreach(json_decode($Funeraria->Campanias) as $campania)
                                        <div class="form-row" id="campania-{{$campania->id}}">
                                            <input type="hidden" name="campania[{{$campania->id}}][id]" class="form-control" value="{{$campania->id}}">
                                            <div class="form-group col-md-5">
                                                <label for="Campaña">Campaña</label>
                                                <input type="text" name="campania[{{$campania->id}}][campania]" class="form-control"
                                                    value="{{$campania->nombre}}" readonly>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="Monto_Base">Monto Base</label>
                                                <input type="text" name="campania[{{$campania->id}}][monto_base]" class="form-control"
                                                    value="{{$campania->monto}}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="Edad_Inicial">Edad Inicial</label>
                                                <input type="text" name="campania[{{$campania->id}}][edad_inicial]" class="form-control"
                                                    value="{{$campania->edad_inicial}}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="Edad_Final">Edad Final</label>
                                                <input type="text" name="campania[{{$campania->id}}][edad_final]" class="form-control"
                                                    value="{{$campania->edad_final}}">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label>Eliminar</label>
                                                <button type="button" class="btn btn-danger btn-block" onClick="eliminarCampania({{$campania->id}})"><b>X</b></button>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <hr>                                
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
                                @php
                                $contadorJson = 0
                                @endphp
                                @foreach(json_decode($Checks) as $check)
                                    @foreach(json_decode($Detalle->Campos) as $rellenos)
                                        @if($rellenos->campo == $check->campo)
                                            @if($rellenos->result == 'Si')
                                            <div class="form-row">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="Hecho"
                                                            name="campo_{{$check->campo}}" id="campo_{{$check->campo}}" checked>{{$check->nombre}}
                                                    </label>
                                                </div>
                                            </div>
                                            @else
                                            <div class="form-row">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="Hecho"
                                                            name="campo_{{$check->campo}}" id="campo_{{$check->campo}}">{{$check->nombre}}
                                                    </label>
                                                </div>
                                            </div>
                                            @endif
                                        @endif
                                    @endforeach                                    
                                    <hr>
                                @php
                                $contadorJson = $contadorJson + 1
                                @endphp
                                @endforeach
                                <input type="hidden" name="cantidadJson" value="{{$contadorJson}}">
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

function agregarCampania(id, campania){
    var fila = id;
    var html = '<div class="form-row" id="campania-'+id+'">\
                    <input type="hidden" name="campania['+id+'][id]" class="form-control" value="'+id+'">\
                    <div class="form-group col-md-5">\
                        <label for="Campaña">Campaña</label>\
                        <input type="text" name="campania['+id+'][campania]" class="form-control"\
                            value="'+campania+'" readonly>\
                    </div>\
                    <div class="form-group col-md-2">\
                        <label for="Monto_Base">Monto Base</label>\
                        <input type="text" name="campania['+id+'][monto_base]" class="form-control"\
                            value="">\
                    </div>\
                    <div class="form-group col-md-2">\
                        <label for="Edad_Inicial">Edad Inicial</label>\
                        <input type="text" name="campania['+id+'][edad_inicial]" class="form-control"\
                            value="">\
                    </div>\
                    <div class="form-group col-md-2">\
                        <label for="Edad_Final">Edad Final</label>\
                        <input type="text" name="campania['+id+'][edad_final]" class="form-control"\
                            value="">\
                    </div>\
                    <div class="form-group col-md-1">\
                        <label>Eliminar</label>\
                        <button type="button" class="btn btn-danger btn-block" onClick="eliminarCampania('+id+')"><b>X</b></button>\
                    </div>\
                </div>';
    $('#campanias').append(html);
}

function eliminarCampania(id){
    $('#campania-' + id).remove();
}
</script>
@endsection
