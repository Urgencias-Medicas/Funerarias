@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles caso</div>

                <div class="card-body align-items-center justify-content-center">
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#funerariaModal">Asignar Funeraria</button>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="codEstudiante">Código de Estudiante</label>
                            <input type="text" class="form-control" id="codEstudiante" name="codEstudiante"
                                placeholder="0000000" value="{{$Caso->Codigo}}" readonly><span id="errmsg"></span>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Ingrese nombre del estudiante" value="{{$Caso->Nombre}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fechaNacimiento">Fecha</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fecha"
                                placeholder="00/00/0000" value="{{$Caso->Fecha}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pohoralhoraiza">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"
                                value="{{date('G:i', strtotime($Caso->Hora))}}" readonly><span id="errmsg"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="causa">Causa</label>
                            <textarea name="causa" id="causa" class="form-control" cols="80"
                                readonly>{{$Caso->Causa}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                value="{{$Caso->Direccion}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="departamento">Departamento</label>
                            <input type="text" name="departamento" id="departamento" class="form-control"
                                value="{{$Caso->Departamento}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="municipio">Municipio</label>
                            <input type="text" name="municipio" id="municipio" class="form-control"
                                value="{{$Caso->Municipio}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="padre">Padre</label>
                            <input type="text" name="padre" id="padre" class="form-control" value="{{$Caso->Padre}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="madre">Madre</label>
                            <input type="text" name="madre" id="madre" class="form-control" value="{{$Caso->Madre}}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lugar">Lugar de los hechos</label>
                        <input type="text" name="lugar" id="lugar" class="form-control" value="{{$Caso->Lugar}}"
                            readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="funerariaModal" tabindex="-1" role="dialog" aria-labelledby="funerariaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="funerariaModalLabel">Funerarias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-funerarias">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Funerarias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-detalle">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: "https://umbd.excess.software/api/getFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                for (var i = 0; i < len; i++) {
                    if(response[i].departamento == "{{$Caso->Departamento}}"){
                        html += '<h3><b>Recomendada</b></h3>\
                        <table class="table">\
                            <thead class="thead-dark">\
                                <tr>\
                                    <th scope="col">Funeraria</th>\
                                    <th scope="col">Departamento</th>\
                                    <th scope="col">Tel.</th>\
                                    <th scope="col">Acciones</th>\
                                </tr>\
                            </thead>\
                            <tbody>\
                                <tr>\
                                    <td>'+response[i].funeraria+'</td>\
                                    <td>'+response[i].departamento+'</td>\
                                    <td>'+response[i].tel_contacto+'</td>\
                                    <td><button class="btn btn-primary" id="idFuneraria" onclick="detalleFuneraria('+response[i].id+')"><i class="fa fa-eye"></i></button> <button class="btn btn-warning" onclick="asignarFuneraria({{$Caso->id}},'+response[i].id+')">Asignar</button></td>\
                                </tr>\
                            </tbody>\
                        </table><br>';
                    }
                }
                html += '<h3><b>Funerarias</b></h3>\
                        <table class="table">\
                            <thead class="thead-dark">\
                                <tr>\
                                    <th scope="col">Funeraria</th>\
                                    <th scope="col">Departamento</th>\
                                    <th scope="col">Tel.</th>\
                                    <th scope="col">Acciones</th>\
                                </tr>\
                            </thead>\
                            <tbody>';
                for (var j = 0; j < len; j++) {
                    if(response[j].departamento != "{{$Caso->Departamento}}"){
                        html += '<tr>\
                                    <td>'+response[j].funeraria+'</td>\
                                    <td>'+response[j].departamento+'</td>\
                                    <td>'+response[j].tel_contacto+'</td>\
                                    <td><button class="btn btn-primary" id="idFuneraria" onclick="detalleFuneraria('+response[j].id+')"><i class="fa fa-eye"></i></button> <button class="btn btn-warning" onclick="asignarFuneraria({{$Caso->id}},'+response[j].id+')">Asignar</button></td>\
                                </tr>';
                    }
                }
                html += '</tbody>\
                        </table><br>';
                $('#modal-funerarias').html(html);
            }
        });
    });

    function detalleFuneraria(id){
        $.ajax({
            url: "https://umbd.excess.software/api/getFunerarias",
            type: 'get',
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                var html = '';
                for (let i = 0; i < len; i++) {
                    if(response[i].id == id){
                        html = '<p><b>Funeraria: '+ response[i].funeraria +'</b></p>\
                        <p><b>Direcci&oacute;n: '+ response[i].direccion +'</b></p>\
                        <p><b>Departamento: '+ response[i].departamento +'</b></p>\
                        <p><b>Tel. Contacto: '+ response[i].tel_contacto +'</b></p>\
                        <p><b>Tel. Coordinador: '+ response[i].tel_coordinador +'</b></p>';
                    }
                }
                $('#modal-detalle').html(html);
                $('#detalleModal').modal('show');
            }
        });
    }

    function asignarFuneraria(caso, id){
        $.ajax({
            url: "/Casos/"+caso+"/asignarFuneraria/"+id,
            type: 'get',
            success: function (response) {
                window.location.href = '/Casos/ver';
            }
        });
    }

</script>
@endsection
