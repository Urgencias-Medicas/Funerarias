@extends('layouts.app')

@section('content')

@if(session('alerta'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('alerta')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Costos</div>
                <div class="card-body align-items-center justify-content-center">
                    <h6><b>GTQ</b></h6>
                    <div class="form-row">
                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="costoServicio">Costo</label>
                            <input type="text" class="form-control" value="{{$Caso->Costo}}" readonly>
                        </div>
                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="Pendiente">Pendiente</label>
                            <input type="text" class="form-control" value="{{$Caso->Costo - $Caso->Pagado}}" readonly>
                        </div>
                        <div class="form-group col-md-4 p-2 m-0 d-flex flex-column justify-content-end">
                            <label for="pagado">Pagado</label>
                            <input type="text" class="form-control"
                                value="{{isset($Caso->Pagado) ? $Caso->Pagado : '0'}}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Medico">Nombre Funeraria</label>
                            <input type="text" class="form-control" readonly
                                value="{{$Caso->Funeraria_Externa_Nombre}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Medico">NIT Funeraria</label>
                            <input type="text" class="form-control" readonly value="{{$Caso->Funeraria_Externa_NIT}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Medico">Banco Funeraria</label>
                            <input type="text" class="form-control" readonly value="{{$Caso->Funeraria_Externa_Banco}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Medico">No. Cuenta Funeraria</label>
                            <input type="text" class="form-control" readonly
                                value="{{$Caso->Funeraria_Externa_NoCuenta}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-3">Historial de Pagos</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Pago</th>
                                        <th scope="col">Serie</th>
                                        <th scope="col">Factura</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Comprobante</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Pagos as $Pago)
                                    <tr>
                                        <td>{{$Pago->id}}</td>
                                        <td>{{$Pago->serie}}</td>
                                        <td>{{$Pago->factura}}</td>
                                        <td>{{$Pago->monto}}</td>
                                        <td><a href="{{$Pago->comprobante}}">Ver</a></td>
                                        <td>{{date("d-m-Y", strtotime("$Pago->fecha"))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@endsection
