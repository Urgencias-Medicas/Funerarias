@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content">
        <div class="col-md-12">

            <h3 class="my-3">Casos</h3>
            <div class="form-row">
                    <div class="form-group col-md-5">
                        
                        <label for="fechaInicio">Causa</label>
                        <div class="input-group ">
                            <select name="causa" id="causa" class="form-control" required="">
                                <option value="Accidente">Accidente</option>
                                <option value="Suicidio">Suicidio</option>
                                <option value="Asesinato">Asesinato</option>
                                <option value="Causas Naturales">Causas Naturales</option>
                                <option value="Enfermedad Comun">Enfermedad Común</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        <button type="button" onclick="window.open('/Casos/ver/' + $('#causa').val(),'_self');" class="btn btn-block btn-info" style="background: #193364;color:white">Aplicar</button>
                    </div>
                    @role('Personal')
                    <div class="form-group col-md-5">
                        <label class="col-md-10">&nbsp;</label>
                        <a class="btn btn-primary float-right" href="/Casos/vistaCrear">Crear Caso</a>
                    </div>
                    @endrole
                </div>
            <div class="table-responsive">
                <table id="table" class="table table-light table-striped border rounded mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Caso #</th>
                            <th scope="col">Correlativo</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col">Causa</th>
                            <th scope="col">Fecha y Hora</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Funeraria</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Casos as $caso)
                        <tr>
                            <td>{{$caso->id}}</td>
                            <td>{{$caso->Correlativo_Completo}}</td>
                            <td>{{$caso->Nombre}}</td>
                            <td>{{$caso->Causa}}</td>
                            <td>{{date('d/m/Y', strtotime($caso->Fecha))}} - {{date('h:i a', strtotime($caso->Hora))}}</td>
                            <td>{{$caso->Departamento}}</td>
                            <td>{{$caso->Funeraria_Nombre}}</td>
                            <td>
                                @if($caso->Estatus == 'Abierto')
                                <span style="color:orange;"><b>{{$caso->Estatus}}</b></span>
                                @elseif($caso->Estatus == 'Asignado')
                                <span style="color:green"><b>{{$caso->Estatus}}</b></span>
                                @elseif($caso->Estatus == 'Cerrado')
                                <span style="color:gray"><b>{{$caso->Estatus}}</b></span>
                                @endif
                            </td>
                            <td>
                                @if($caso->Solicitud == 'Pendiente')
                                <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Abrir caso</button></a>
                                @elseif(!$caso->Funeraria)
                                <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Abrir caso</button></a>
                                @else
                                <a href="/Casos/{{$caso->id}}/ver"><button class="btn btn-link">Abrir caso</button></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.noConflict();
        var table = $('#table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Sin registros",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar: "
            }
        });
    });

</script>
@endsection
