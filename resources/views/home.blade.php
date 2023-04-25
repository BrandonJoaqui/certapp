@extends('layouts.app')

@section('content')


    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Bienvenido...

        <div class="mt-4" >
            <a 
            href="/consulta_certificados" 
            class="btn btn-primary btn-sm" 
            target="_blank"
            >
            <i class="fa fa-external-link" aria-hidden="true"></i>
            Fomulario consulta pública</a>
        </div>
    </div>


@endsection
