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
</div>
<div class="">
    <div class="row">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Caso</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tutor</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Tipo de Muerte</th>
                    <th scope="col">Causa</th>
                    <th scope="col">Desc. Causa</th>
                    <th scope="col">Funeraria</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Evaluacion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$Caso->id}}</td>
                    <td>{{$Caso->Nombre}}</td>
                    <td>{{$Caso->Tutor}}</td>
                    <td>{{strtoupper($Caso->Municipio)}}</td>
                    <td>{{strtoupper($Caso->Departamento)}}</td>
                    <td>{{$Caso->Causa}}</td>
                    <td>{{$Caso->Causa_Desc}}</td>
                    <td>{{$Caso->Causa_Especifica}}</td>
                    <td>{{$Caso->Funeraria_Nombre}}</td>
                    <td>{{$Caso->Fecha}}</td>
                    <td>{{$Caso->Evaluacion}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div class="row text-center">
        <div class="col">
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
        <div class="col">
            <h1><b>Fotografías</b></h1>
        </div>
        <br>
        <br>
        <table class="table table-borderless">
            <br><br>
            <thead style="border: 0 !important;">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <br><br>
            <tbody style="border: 0 !important;">
                @if($Archivos)
                @foreach(array_chunk($Archivos, 3) as $chunked_fotos)
                        <tr>
                            @foreach($chunked_fotos as $foto)
                                <td><img src="{{url($foto)}}"
                        style="width: 45%; height: auto;" class="img-responsive"></td> 
                            @endforeach
                        </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
