@extends('layouts.app')
@section('content')
    @isset($equipo)
        <div class="card-header">Editando equipo</div>
    @else
        <div class="card-header">Creando equipo</div>
    @endisset
    
    <div class="card-body">
        @isset($equipo)
        <form id="vueform" method="POST" action="{{url('/equipos/'.$equipo->id)}}">
            <input type="hidden" name="_method" value="PUT">
        @else
        <form id="vueform" method="POST" action="{{url('/equipos')}}">
        @endif
            @csrf
        

            <input-text
                caption_text="Placa"
                placeholder_text="Ingrese placa"
                required="true"
                input_name="placa"
                @isset($equipo)
                current_value="{{$equipo->placa}}"
                @endisset
            ></input-text>

            <input-text
                caption_text="Serial"
                placeholder_text="Ingrese serial"
                required="false"
                class="mt-2"
                input_name="serial"
                @isset($equipo)
                current_value="{{$equipo->serial}}"
                @endisset
            ></input-text>

            <input-text
                caption_text="Descripción"
                placeholder_text="Ingrese el valor"
                required="true"
                class="mt-2"
                input_name="descripcion"
                @isset($equipo)
                current_value="{{$equipo->descripcion}}"
                @endisset
            ></input-text>


            <input-text
                caption_text="Capacidad"
                placeholder_text="Ingrese capacidad"
                input_name="capacidad"
                class="mt-2"
                @isset($equipo)
                current_value="{{$equipo->capacidad}}"
                @endisset
            ></input-text>

            <savecancel-btns
                back_url="{{url('/equipos')}}"
            ></savecancel-btns>
        </form>
    </div>     
@endsection