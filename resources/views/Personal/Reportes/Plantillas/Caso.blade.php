<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<!--<div class="row">
    <div class="col-8 float-left">
        <img src="https://centrourgenciasmedicas.com/wp-content/uploads/2020/08/LogoUM-06.png"
            style="width: 40%; height: auto;" class="img-responsive">
    </div>
</div>-->
<br>
<div class="container">
    <div class="row text-center">
        <div class="">
            <h5><b>Detalles caso - #{{$Caso->id ??  'SIN DATOS'}}</b></h5>
        </div>
    </div>
    <div class="row">
        <table cellpadding = "0" class="table table-bordered" style="font-size: 50%; padding: 0px !important; margin: 0px !important;">
            <tbody>
                <tr>
                    <th><b>Nombre</b></th>
                    <th>{{$Caso->Nombre}}</th>
                    <th><b>Tutor</b></th>
                    <th>{{$Caso->Tutor}}</th>
                </tr>
                <tr>
                    <th><b>Codigo</b></th>
                    <th>{{$Caso->Codigo}}</th>
                    <th><b>Municipio</b></th>
                    <th>{{strtoupper($Caso->Municipio)}}</th>
                </tr>
                <tr>
                    <th><b>Tipo de muerte</b></th>
                    <th>{{$Caso->Causa}}</th>
                    <th><b>Departamento</b></th>
                    <th>{{strtoupper($Caso->Departamento)}}</th>
                </tr>
                <tr>
                    <th><b>Causa</b></th>
                    <th>{{$Caso->Causa_Desc}}</th>
                    <th>Reporta</th>
                    <th>{{$Caso->NombreReporta}}</th>
                </tr>
                <tr>
                    <th><b>Desc. Causa</b></th>
                    <th>{{$Caso->Causa_Especifica}}</th>
                    <th><b>Fecha/Hora</b></th>
                    <th>{{date('d-m-Y', strtotime($Caso->Fecha)).' / '.date('H:i', strtotime($Caso->Hora))}}</th>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="row text-center">
        <div class="col">
            <h5><b>Fotografías</b></h5>
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
                @foreach(array_chunk($Archivos, 2) as $chunked_fotos)
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
    
