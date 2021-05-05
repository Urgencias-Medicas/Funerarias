@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <button type="button" class="btn btn-link"><a href="">< Atrás</a></button>
            <div class="card">
                <div class="card-header">Información</div>

                <div class="card-body align-items-center justify-content-center">
                    <form action="/Personal/Funeraria/{{$Funeraria->id}}/{{$Detalle->id}}/guardar" method="post">
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
                        <div class="form-row">
                            <div class="form-check">
                                <h3>Información general</h3>
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#info">Ver información</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <a href="/pasos/{{$Funeraria->id}}/Aprobado/2" type="button" class="btn btn-success">Aprobar</a>
                            <a href="/pasos/{{$Funeraria->id}}/Denegado/2" type="button" class="btn btn-danger">Denegar</a>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <h3>Documentación</h3>
                                </label>
                            </div>
                        </div>
                        <hr>
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
                                        <td>{{$docto->Documento}}</td>
                                        <td>{{$docto->Estatus}}</td>
                                        <td><a href="{{$docto->Ruta}}" class="btn btn-info">Ver</a><a onclick="denegarDocto({{$docto->Id}});" class="btn btn-danger">Denegar</a><a href="/Personal/Funeraria/{{$Funeraria->id}}/{{$docto->Id}}/Aprobado/-" class="btn btn-success">Aprobar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col">
                            <a href="/pasos/{{$Funeraria->id}}/Aprobado/3" class="btn btn-success">Aprobar</a>
                            <a href="/pasos/{{$Funeraria->id}}/Denegado/3" class="btn btn-danger">Denegar</a>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <h3>Contrato</h3>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <a href="/pasos/{{$Funeraria->id}}/Aprobado/4" class="btn btn-success">Aprobar</a>
                            <a href="/pasos/{{$Funeraria->id}}/Denegado/4" class="btn btn-danger">Denegar</a>
                            </div>
                        </div>
                        <hr>
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

<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoLabel">Información de funeraria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @foreach($Detalles_Funeraria as $detalle)
                @if($detalle->Campo == 'LicenciaAmbiental')

                @elseif($detalle->Campo == 'InfoGeneral')

                @elseif($detalle->Campo == 'Documentacion')

                @elseif($detalle->Campo == 'Convenio')
                
                @else
                {{$detalle->Campo}} - {{$detalle->Valor}}
                <br>
                @endif
            @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
