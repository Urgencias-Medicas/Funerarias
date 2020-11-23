<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<div class="row">
    <div class="col-8 float-left">
        <img src="https://centrourgenciasmedicas.com/wp-content/uploads/2020/08/LogoUM-06.png"
            style="width: 40%; height: auto;" class="img-responsive">
    </div>
</div>
<br>
<div class="container">
    <div class="row text-center">
        <div class="">
            <h1><b>Detalles caso - #{{$Caso->id ??  'SIN DATOS'}}</b></h1>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="w-10">Fecha</th>
                        <th class="w-10">Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-10">{{$Caso->Fecha ??  'SIN DATOS'}}</td>
                        <td class="w-10">{{date('G:i', strtotime($Caso->Hora)) ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-1">Agente</th>
                        <th class="col-sm-2">Cod. Estudiante</th>
                        <th class="col-sm-5">Nombre</th>
                        <th class="col-sm-2">Edad</th>
                        <th class="col-sm-2">Aseguradora</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-1">{{$Caso->Agente ??  'SIN DATOS'}}</td>
                        <td class="col-sm-2">{{$Caso->Codigo ??  'SIN DATOS'}}</td>
                        <td class="col-sm-5">{{$Caso->Nombre ??  'SIN DATOS'}}</td>
                        <td class="col-sm-2">{{$Caso->Edad ??  'SIN DATOS'}}</td>
                        <td class="col-sm-2">{{$Caso->Aseguradora ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-2">Tipo de muerte</th>
                        <th class="col-sm-4">Causa</th>
                        <th class="col-sm-6">Detalles Causa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-2">{{$Caso->Causa ??  'SIN DATOS'}}</td>
                        <td class="col-sm-4">{{$Caso->Causa_Desc ??  'SIN DATOS'}}</td>
                        <td class="col-sm-6">{{$Caso->Causa_Especifica ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-3">Departamento</th>
                        <th class="col-sm-3">Municipio</th>
                        <th class="col-sm-3">Direccion</th>
                        <th class="col-sm-3">Lugar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-3">{{$Caso->Departamento ??  'SIN DATOS'}}</td>
                        <td class="col-sm-3">{{$Caso->Municipio ??  'SIN DATOS'}}</td>
                        <td class="col-sm-3">{{$Caso->Direccion ??  'SIN DATOS'}}</td>
                        <td class="col-sm-3">{{$Caso->Lugar ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-4">Nombre de quien reporta</th>
                        <th class="col-sm-4">Relación</th>
                        <th class="col-sm-4">Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-4">{{$Caso->NombreReporta ??  'SIN DATOS'}}</td>
                        <td class="col-sm-4">{{$Caso->RelacionReporta ??  'SIN DATOS'}}</td>
                        <td class="col-sm-4">{{$Caso->TelReporta ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-3">Padre</th>
                        <th class="col-sm-3">Tel. Padre</th>
                        <th class="col-sm-3">Madre</th>
                        <th class="col-sm-3">Tel. Madre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-3">{{$Caso->Padre ??  'SIN DATOS'}}</td>
                        <td class="col-sm-3">{{$Caso->TelPadre ??  'SIN DATOS'}}</td>
                        <td class="col-sm-3">{{$Caso->Madre ??  'SIN DATOS'}}</td>
                        <td class="col-sm-3">{{$Caso->TelMadre ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-4">Tutor</th>
                        <th class="col-sm-4">DPI</th>
                        <th class="col-sm-4">Parentesco</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-4">{{$Caso->Tutor ??  'SIN DATOS'}}</td>
                        <td class="col-sm-4">{{$Caso->DPITutor ??  'SIN DATOS'}}</td>
                        <td class="col-sm-4">{{$Caso->ParentescoTutor ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-6">Teléfono</th>
                        <th class="col-sm-6">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-6">{{$Caso->TelTutor ??  'SIN DATOS'}}</td>
                        <td class="col-sm-6">{{$Caso->EmailTutor ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-12">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-12">{{$Caso->Comentario ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="col-sm-6">Medico</th>
                        <th class="col-sm-6">Idioma</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-6">{{$Caso->Medico ??  'SIN DATOS'}}</td>
                        <td class="col-sm-6">{{$Caso->Idioma ??  'SIN DATOS'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <br>
    <div class="row text-cente">
        <div class="col-md-12">
            <h1><b>Pagos</b></h1>
        </div>
    </div>
    <div class="row text-center">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Serie</th>
                    <th scope="col">Factura</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Pagos as $pago)
                <tr>
                    <td>{{$pago->id}}</td>
                    <td>{{$pago->serie}}</td>
                    <td>{{$pago->factura}}</td>
                    <td>{{$pago->fecha}}</td>
                    <td>{{$pago->monto}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="5" scope="colgroup"><b>Total: </b>{{$Caso->Pagado}}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div class="row text-center">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th><h1><b>Fotografías</b></h1></th>
                </tr>
            </thead>
            <tbody>
                @foreach($Archivos as $foto)
                <tr>
                    <td><img src="{{url('/images/'.$foto)}}"
            style="width: 80%; height: auto;" class="img-responsive"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
