@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tablas CHN</div>

                <div class="card-body">
                    <form method="POST" action="/Personal/Tabla_CHN">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12" id="selectcol">
                            <label for="descripcion_causa">Campañas a mostrar a CHN</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <select name="campanias[]" id="descripcion_causa_select"
                                    class="form-control" multiple onchange="unlockBtn();">
                                    <!--<option value="0" selected>-- Sin selección --</option>-->
                                    @foreach($Campanias as $campania)
                                    <option value="{{$campania}}">{{$campania}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" id="submit_btn" class="btn btn-primary" disabled>
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
<script>
    tail.select("#descripcion_causa_select", {
            search: true,
            locale: "es",
            hideSelected: true,
            hideDisabled: true,
            multiShowCount: false,
            multiContainer: true
        });

    function unlockBtn(){
        $('#submit_btn').prop('disabled', false);

        if($('#descripcion_causa_select').val() == ''){
            $('#submit_btn').prop('disabled', true);
        }
    }
</script>
@endsection