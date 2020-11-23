<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<div class="row">
    <div class="col-8 float-left">
        <img src="https://centrourgenciasmedicas.com/wp-content/uploads/2020/08/LogoUM-06.png"
            style="width: 40%; height: auto;" class="img-responsive">
    </div>
    <div class="col-4 float-right">
        <b>Fecha Inicial: {{date("d-m-Y", strtotime($FechaInicio))}}</b>
        <br>
        <b>Fecha Final: {{date("d-m-Y", strtotime($FechaFin))}}</b>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="row">
    <div class="col-12 text-center">
        <h4><b>Reporte general</b></h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Caso</th>
                    <th scope="col">Mes</th>
                    <th scope="col">Estudiante</th>
                    <th scope="col">Nombre Estudiante</th>
                    <th scope="col">Tutor</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Tipo de Muerte</th>
                    <th scope="col">Causa</th>
                    <th scope="col">Desc. Causa</th>
                    <th scope="col">Funeraria</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Evaluacion</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Casos as $caso)
                <tr>
                    <td>{{$caso->id}}</td>
                    <td>{{date('F', strtotime($caso->Fecha))}}</td>
                    <td>{{$caso->Codigo}}</td>
                    <td>{{$caso->Nombre}}</td>
                    <td>{{$caso->Tutor}}</td>
                    <td>{{strtoupper($caso->Municipio)}}</td>
                    <td>{{strtoupper($caso->Departamento)}}</td>
                    <td>{{$caso->Causa}}</td>
                    <td>{{$caso->Causa_Desc}}</td>
                    <td>{{$caso->Causa_Especifica}}</td>
                    <td>{{$caso->Funeraria_Nombre}}</td>
                    <td>{{$caso->Fecha}}</td>
                    <td>{{$caso->Evaluacion}}</td>
                    <td>{{$caso->Costo}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="row text-center">
    <div class="col-6">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Causa</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_general = 0
                @endphp
                @foreach($Conteo as $conteo)
                <tr>
                    <td>{{$conteo->Causa}}</td>
                    <td>{{$conteo->total}}</td>
                </tr>
                @php
                $total_general += $conteo->total
                @endphp
                @endforeach
                <tr>
                    <td>Total general</td>
                    <td>{{$total_general}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="row">
    <div class="col-6">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Funeraria</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_general = 0
                @endphp
                @foreach($Conteo_funerarias as $conteo)
                <tr>
                    <td>{{$conteo->Funeraria}}</td>
                    <td>{{$conteo->total}}</td>
                </tr>
                @php
                $total_general += $conteo->total
                @endphp
                @endforeach
                <tr>
                    <td>Total general</td>
                    <td>{{$total_general}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<br><br><br><br><br><br><br><br>
<div class="row">
    <div class="col-6">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <td></td>
                    <th scope="col">Causa</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Departamentos as $departamento)
                    <tr>
                        <th colspan="3" scope="colgroup">{{$departamento->Departamento}}</th>
                    </tr>
                    @foreach($departamento->Causas_arreglo as $causa)
                    <tr>
                        <td>{{$causa->Causa}}</td>
                        <td>{{$causa->total}}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>