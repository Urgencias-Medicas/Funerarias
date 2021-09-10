@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cambiar Datos Bancarios</div>

                <div class="card-body">
                    <form method="POST" action="/Funerarias/datosBancarios/guardar" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="NIT">NIT</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="NIT" name="NIT"
                                    placeholder="" value="{{isset($Funeraria->NIT) ? $Funeraria->NIT : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="Banco">Banco</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="Banco" name="Banco"
                                    placeholder="" value="{{isset($Funeraria->Banco) ? $Funeraria->Banco : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="Cuenta">Cuenta</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="Cuenta" name="Cuenta"
                                    placeholder="" value="{{isset($Funeraria->Cuenta) ? $Funeraria->Cuenta : ''}}">
                                <small>El nombre de la cuenta debe coincidir con el de la factura</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="Comprobante">Comprobante</label>
                            
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="Comprobante" name="Comprobante" required>
                                <small>Debe subir un docto que verifique su No. de cuenta</small>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btn-register">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
