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
            @if(strtoupper($Caso->Nombre_Aseguradora) == 'SEGURED')
            <tbody>
                <tr>
                    <th><b>Nombre del fallecido</b></th>
                    <th>{{$Caso->Nombre}}</th>
                    <th><b>Persona que reporta suceso</b></th>
                    <th>{{$Caso->NombreReporta}}</th>
                </tr>
                <tr>
                    <th><b>Edad del fallecido</b></th>
                    <th>{{$Caso->Edad}}</th>
                    <th><b>Municipio</b></th>
                    <th>{{$Caso->Municipio}}</th>
                </tr>
                <tr>
                    <th><b>Póliza</b></th>
                    <th>{{$Caso->Poliza}}</th>
                    <th><b>Departamento</b></th>
                    <th>{{$Caso->Departamento}}</th>
                </tr>
                <tr>
                    <th><b>Causa de muerte</b></th>
                    <th>{{$Caso->Causa_Especifica}}</th>
                    <th><b>Teléfono</b></th>
                    <th>{{$Caso->TelTutor}}</th>
                </tr>                
                <tr>
                    <th><b>Fecha de muerte</b></th>
                    <th>{{$Caso->Fecha}}</th>
                    <th><b>Hora en que reportan fallecimiento</b></th>
                    <th>{{$Caso->Hora}}</th>
                </tr>
                <tr>
                    <th><b>Lugar del fallecimiento</b></th>
                    <th>{{$Caso->Lugar}}</th>
                    <th><b>Funeraria que atiende</b></th>
                    <th>{{$Caso->Funeraria_Nombre}}</th>
                </tr>
            </tbody>
            @elseif(strtoupper($Caso->Nombre_Aseguradora) == 'CHN')
            <tbody>
                <tr>
                    <th><b>Nombre del fallecido</b></th>
                    <th>{{$Caso->Nombre}}</th>
                    <th><b>Persona que reporta suceso</b></th>
                    <th>{{$Caso->NombreReporta}}</th>
                </tr>
                <tr>
                    <th><b>Edad del fallecido</b></th>
                    <th>{{$Caso->Edad}}</th>
                    <th><b>Municipio</b></th>
                    <th>{{$Caso->Municipio}}</th>
                </tr>
                <tr>
                    <th><b>Número de DPI</b></th>
                    <th>-</th>
                    <th><b>Departamento</b></th>
                    <th>{{$Caso->Departamento}}</th>
                </tr>
                <tr>
                    <th><b>Causa de muerte</b></th>
                    <th>{{$Caso->Causa_Especifica}}</th>
                    <th><b>Teléfono</b></th>
                    <th>{{$Caso->TelTutor}}</th>
                </tr>                
                <tr>
                    <th><b>Fecha de muerte</b></th>
                    <th>{{$Caso->Fecha}}</th>
                    <th><b>Hora en que reportan fallecimiento</b></th>
                    <th>{{$Caso->Hora}}</th>
                </tr>
                <tr>
                    <th><b>Lugar del fallecimiento</b></th>
                    <th>{{$Caso->Lugar}}</th>
                    <th><b>Funeraria que atiende</b></th>
                    <th>{{$Caso->Funeraria_Nombre}}</th>
                </tr>
            </tbody>
            @elseif(strtoupper($Caso->Nombre_Aseguradora) == strtoupper('Seguro Escolar') || strtoupper($Caso->Nombre_Aseguradora) == strtoupper('Seguro Medico Estudiantil'))
            <tbody>
                <tr>
                    <th><b>Nombre del fallecido</b></th>
                    <th>{{$Caso->Nombre}}</th>
                    <th><b>Nombre Tutor</b></th>
                    <th>{{$Caso->Tutor}}</th>
                </tr>
                <tr>
                    <th><b>Edad del fallecido</b></th>
                    <th>{{$Caso->Edad}}</th>
                    <th><b>Municipio</b></th>
                    <th>{{$Caso->Municipio}}</th>
                </tr>
                <tr>
                    <th><b>Código de estudiante</b></th>
                    <th>{{$Caso->Codigo}}</th>
                    <th><b>Departamento</b></th>
                    <th>{{$Caso->Departamento}}</th>
                </tr>
                <tr>
                    <th><b>Causa de muerte</b></th>
                    <th>{{$Caso->Causa_Especifica}}</th>
                    <th><b>Teléfono</b></th>
                    <th>{{$Caso->TelTutor}}</th>
                </tr>                
                <tr>
                    <th><b>Fecha de muerte</b></th>
                    <th>{{$Caso->Fecha}}</th>
                    <th><b>Persona que reporta suceso</b></th>
                    <th>{{$Caso->NombreReporta}}</th>
                </tr>
                <tr>
                    <th><b>Hora en que reportan fallecimiento</b></th>
                    <th>{{$Caso->Hora}}</th>
                    <th><b>Funeraria que atiende</b></th>
                    <th>{{$Caso->Funeraria_Nombre}}</th>
                </tr>
            </tbody>
            @endif
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
    
