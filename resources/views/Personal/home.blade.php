@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body align-items-center d-flex justify-content-center">
                    <a href="/Casos/ver"><button class="btn btn-info">Ver Casos</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
