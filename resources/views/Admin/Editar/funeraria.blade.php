@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" class="btn btn-link"> </button>
            <div class="card">

                <div class="card-body align-items-center justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Info. General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab"
                                aria-controls="info" aria-selected="false">Info. Detallada</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="doct-tab" data-toggle="tab" href="#doct" role="tab"
                                aria-controls="doct" aria-selected="false">Documentacion</a>
                        </li>
                        <!--<li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contrato</a>
                            </li>-->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <form action="/Personal/Funeraria/{{$Funeraria->Id_Funeraria}}/{{$Detalle->id}}/guardar"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre Funeraria" value="{{$Funeraria->Nombre}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="diminutivo">Diminutivo</label>
                                    <input type="text" class="form-control" id="diminutivo" name="diminutivo"
                                        value="{{$Funeraria->Diminutivo}}" required>
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
                                    <select name="selectCampaña" id="selectCampaña" class="form-control"
                                        onchange="$('#agregar_campana_btn').removeAttr('disabled');">
                                        <option selected disabled>-- Seleccione campaña --</option>
                                        @foreach($Campanias as $campania)
                                        <option value="{{$campania->id}}">
                                            {{$campania->Nombre.', '.$campania->Nombre_Aseguradora. ' ('.$campania->Moneda.')'}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <button type="button" class="btn btn-success" id="agregar_campana_btn"
                                            onClick="agregarCampania($('#selectCampaña').val(), $('#selectCampaña option:selected').text())"
                                            disabled><i class="fa fa-plus" aria-hidden="true"></i> Agregar
                                            campaña</button>
                                    </div>
                                </div>
                                <hr>
                                <div id="campanias">
                                    @if($Funeraria->Campanias)
                                    @foreach(json_decode($Funeraria->Campanias) as $campania)
                                    <div class="form-row" id="campania-{{$campania->id}}">
                                        <input type="hidden" name="campania[{{$campania->id}}][id]" class="form-control"
                                            value="{{$campania->id}}">
                                        <div class="form-group col-md-5">
                                            <label for="Campaña">Campaña</label>
                                            <input type="text" name="campania[{{$campania->id}}][campania]"
                                                class="form-control" value="{{$campania->nombre}}" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Monto_Base">Monto Base</label>
                                            <input type="text" name="campania[{{$campania->id}}][monto_base]"
                                                class="form-control" value="{{$campania->monto}}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Edad_Inicial">Edad Inicial</label>
                                            <input type="text" name="campania[{{$campania->id}}][edad_inicial]"
                                                class="form-control" value="{{$campania->edad_inicial}}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Edad_Final">Edad Final</label>
                                            <input type="text" name="campania[{{$campania->id}}][edad_final]"
                                                class="form-control" value="{{$campania->edad_final}}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>Eliminar</label>
                                            <button type="button" class="btn btn-danger btn-block"
                                                onClick="eliminarCampania({{$campania->id}})"><b>X</b></button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="activa">Activa</label>
                                    <select name="activo" id="activo" class="form-control">
                                        @if($Funeraria->Activa == 'No')
                                        <option value="No" selected>No</option>
                                        <option value="Si">Si</option>
                                        @else
                                        <option value="Si" selected>Si</option>
                                        <option value="No">No</option>
                                        @endif
                                    </select>
                                </div>
                                <hr>


                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary float-right">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <form action="/Funeraria/info/actualizarInfo/{{$Funeraria->Id_Funeraria}}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="tipo_funneraria">Tipo de funeraria</label>
                                                <select name="tipo_funeraria" class="form-control">
                                                    <option disabled>--Seleccione--</option>
                                                    <option {{$Detalles_Funeraria['TipoFuneraria'] == 'A' ? 'selected' : ''}} value="A">A</option>
                                                    <option {{$Detalles_Funeraria['TipoFuneraria'] == 'B' ? 'selected' : ''}} value="B">B</option>
                                                    <option {{$Detalles_Funeraria['TipoFuneraria'] == 'C' ? 'selected' : ''}} value="C">C</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="NIT">NIT</label>
                                                <input type="text" name="nit" id="NIT" class="form-control" value="{{$Detalles_Funeraria['NIT']}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" name="telefono" id="telefono" class="form-control"
                                                    value="{{$Detalles_Funeraria['Telefono']}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" name="direccion" id="direccion" class="form-control"
                                                    value="{{$Detalles_Funeraria['Direccion']}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="nombre_contacto">Nombre contacto principal</label>
                                                <input type="text" name="nombre_contacto" id="nombre_contacto"
                                                    class="form-control" value="{{$Detalles_Funeraria['NombreContacto']}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="numero_contacto">Número contacto principal</label>
                                                <input type="text" name="numero_contacto" id="numero_contacto"
                                                    class="form-control" value="{{$Detalles_Funeraria['TelContacto']}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-success">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="doct" role="tabpanel" aria-labelledby="doct-tab">
                            <br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($DoctosFuneraria as $docto)
                                    <tr>
                                        <td>{{$docto->Documento}}</td>
                                        <td><a href="{{$docto->Ruta}}" class="">Ver</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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

    });

    function agregarCampania(id, campania) {
        var fila = id;
        var html = '<div class="form-row" id="campania-' + id + '">\
                    <input type="hidden" name="campania[' + id + '][id]" class="form-control" value="' + id + '">\
                    <div class="form-group col-md-5">\
                        <label for="Campaña">Campaña</label>\
                        <input type="text" name="campania[' + id + '][campania]" class="form-control"\
                            value="' + campania + '" readonly>\
                    </div>\
                    <div class="form-group col-md-2">\
                        <label for="Monto_Base">Monto Base</label>\
                        <input type="number" name="campania[' + id + '][monto_base]" class="form-control"\
                            value="">\
                    </div>\
                    <div class="form-group col-md-2">\
                        <label for="Edad_Inicial">Edad Inicial</label>\
                        <input type="number" name="campania[' + id + '][edad_inicial]" class="form-control"\
                            value="">\
                    </div>\
                    <div class="form-group col-md-2">\
                        <label for="Edad_Final">Edad Final</label>\
                        <input type="number" name="campania[' + id + '][edad_final]" class="form-control"\
                            value="">\
                    </div>\
                    <div class="form-group col-md-1">\
                        <label>Eliminar</label>\
                        <button type="button" class="btn btn-danger btn-block" onClick="eliminarCampania(' + id + ')"><b>X</b></button>\
                    </div>\
                </div>';
        $('#campanias').append(html);
    }

    function eliminarCampania(id) {
        $('#campania-' + id).remove();
    }

</script>
@endsection
