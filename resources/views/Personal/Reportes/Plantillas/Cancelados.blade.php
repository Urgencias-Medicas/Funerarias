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
<div class="row">
    <div class="col-12 text-center">
        <h4><b>Reporte de casos Cancelados</b></h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered text-center">
            <thead class="">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Aseguradora</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Municipio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Casos as $caso)
                <tr>
                    <td>{{$caso->Nombre}}</td>
                    <td>{{$caso->Edad}}</td>
                    <td>{{$caso->Nombre_Aseguradora}}</td>
                    <td>{{$caso->Fecha}}</td>
                    <td>{{$caso->Departamento}}</td>
                    <td>{{$caso->Municipio}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
