@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/basic.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dropzone {
        border:2px dashed #999999;
        border-radius: 10px;
    }
    .dropzone .dz-default.dz-message {
        height: 171px;
        background-size: 132px 132px;
        margin-top: -101.5px;
        background-position-x:center;

    }
    .dropzone .dz-default.dz-message span {
        display: block;
        margin-top: 145px;
        font-size: 20px;
        text-align: center;
    }
    li{
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Visualizar caso</div>

                <div class="card-body align-items-center justify-content-center">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            placeholder="Ingrese nombre del estudiante" value="{{$Caso->Nombre}}" readonly>
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
                    <hr>
                    <h1>Archivos</h1>
                        <ul class="list-group">
                            @foreach($Archivos as $archivo)
                                <li class="list-group-item"><b><a target="popup" onclick="window.open('/images/caso{{$Caso->id}}-{{$archivo}}','Archivo-Caso{{$Caso->id}}','width=600,height=400')">{{$archivo}}</a></b></li>
                            @endforeach
                        </ul>
                    <hr>
                    <div class="form-group">
                        <form action="/Funeraria/Caso/{{$Caso->id}}/guardarMedia" enctype="multipart/form-data" class="dropzone" id="fileupload" method="POST">
                            @csrf
                            <div class="fallback">
                            <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
  Dropzone.options.fileupload = {

  }

if (typeof Dropzone != 'undefined') {
  Dropzone.autoDiscover = false;
}

;
(function ($, window, undefined) {
  "use strict";

  $(document).ready(function () {
    // Dropzone Example
    if (typeof Dropzone != 'undefined') {
      if ($("#fileupload").length) {
        var dz = new Dropzone("#fileupload"),
          dze_info = $("#dze_info"),
          status = {
            uploaded: 0,
            errors: 0
          };
        var $f = $('<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>');
        dz.on("success", function (file, responseText) {

            var _$f = $f.clone();

            _$f.addClass('success');

            _$f.find('.name').html(file.name);
            if (file.size < 1024) {
              _$f.find('.size').html(parseInt(file.size) + ' KB');
            } else {
              _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
            }
            _$f.find('.type').html(file.type);
            _$f.find('.status').html('Uploaded <i class="entypo-check"></i>');

            dze_info.find('tbody').append(_$f);

            status.uploaded++;

            dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

            toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {
              timeOut: 50000000
            });

          })
          .on('error', function (file) {
            var _$f = $f.clone();

            dze_info.removeClass('hidden');

            _$f.addClass('danger');

            _$f.find('.name').html(file.name);
            _$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
            _$f.find('.type').html(file.type);
            _$f.find('.status').html('Uploaded <i class="entypo-cancel"></i>');

            dze_info.find('tbody').append(_$f);

            status.errors++;

            dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');

            toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {
              timeOut: 5000
            });
          });
      }
    }
  });
})(jQuery, window); 
</script>
@endsection
