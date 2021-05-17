@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <button type="button" class="btn btn-link"><a href="">< Atrás</a></button>
            <div class="card">
                <div class="card-header">Información</div>

                <div class="card-body align-items-center justify-content-center">
                    <form action="/Personal/Funeraria/{{$Funeraria->id}}/{{$Detalle->id}}/guardarNueva" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Nombre Funeraria" value="{{$Funeraria->name}}" readonly>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{$Funeraria->email}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
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
                        </div>
                        <hr>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Info. General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Documentacion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contrato</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        @foreach($Detalles_Funeraria as $detalle)
                                            @if($detalle->Campo == 'LicenciaAmbiental')

                                            @elseif($detalle->Campo == 'InfoGeneral')

                                            @elseif($detalle->Campo == 'Documentacion')

                                            @elseif($detalle->Campo == 'Convenio')
                                            
                                            @else
                                            <b>{{$detalle->Campo}}</b> - {{$detalle->Valor}}
                                            <br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="/pasos/{{$Funeraria->id}}/Aprobado/2" type="button" class="btn btn-success btn-block">Aprobar</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/pasos/{{$Funeraria->id}}/Denegado/2" type="button" class="btn btn-danger btn-block">Denegar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Estatus</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($DoctosFuneraria as $docto)
                                            <tr>
                                                <td><a href="{{$docto->Ruta}}" class="">{{$docto->Documento}}</a> </td>
                                                <td>{{$docto->Estatus}}</td>
                                                <td><a href="/Personal/Funeraria/{{$Funeraria->id}}/{{$docto->Id}}/Aprobado/-" class="btn btn-success mx-3">Aprobar</a><a onclick="denegarDocto({{$docto->Id}});" class="btn btn-danger">Denegar</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="/pasos/{{$Funeraria->id}}/Aprobado/3" class="btn btn-success btn-block">Aprobar</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/pasos/{{$Funeraria->id}}/Denegado/3" class="btn btn-danger btn-block">Denegar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="/convenio/{{$Funeraria->id}}"><h1>Descargar convenio</h1></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
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

<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Denegar documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h3>Motivos</h3>
        <textarea name="denegar" id="denegar" class="form-control" onchange="changeBtnDenegar();"></textarea>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" id="btn-denegar" href="">Aceptar</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
function denegarDocto(id){
    console.log(id);
    $('#myModal').modal('show')
    $("#btn-denegar").attr("href", "/Personal/Funeraria/6/"+id+"/Denegado")
}

function changeBtnDenegar(id){
    var motivo = $('#denegar').val();
    console.log('test');
    var link = $('#btn-denegar');
    link.attr('href', link.attr('href') + '/' + motivo);
    //$("#btn-denegar").attr("href", "/Personal/Funeraria/6/"+id+"/Denegado/"+motivo)
}
</script>
@endsection
