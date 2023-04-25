@extends('layouts.app')
@section('content')
    @isset($competencia)
        <div class="card-header">Editando competencia</div>
    @else
        <div class="card-header">Creando competencia</div>
    @endisset
    
    <div class="card-body">
        @isset($competencia)
        <form id="vueform" method="POST" action="{{url('/competencias/'.$competencia->id)}}">
            <input type="hidden" name="_method" value="PUT">
        @else
        <form id="vueform" method="POST" action="{{url('/competencias')}}">
        @endif
            @csrf
        
            <input-selector
                caption_text="Ámbito de aplicación"
                placeholder_text="Ámbito de aplicacion"
                required="true"
                class="mt-2"
                input_name="ambito"
                :input_values="['PERSONAS', 'EQUIPOS']"
                @isset($competencia)
                current_value="{{$competencia->ambito}}"
                @endisset
            ></input-selector>

            <input-text
                caption_text="Descripción"
                placeholder_text="Descripción larga para mostrar en certificados"
                required="true"
                input_name="descripcion"
                @isset($competencia)
                current_value="{{$competencia->descripcion}}"
                @endisset
            ></input-text>

            <input-text
                caption_text="Descripción corta"
                placeholder_text="Descripción corta para mostrar en espacios de certificado de poco espacio"
                required="false"
                class="mt-2"
                input_name="descripcion_corta"
                @isset($competencia)
                current_value="{{$competencia->descripcion_corta}}"
                @endisset
            ></input-text>

            <input-text
                caption_text="Normatividad"
                placeholder_text="Ingrese el valor"
                required="true"
                class="mt-2"
                input_name="normatividad"
                @isset($competencia)
                current_value="{{$competencia->normatividad}}"
                @endisset
            ></input-text>


            <input-text
                caption_text="Esquema"
                placeholder_text="Ingrese esquema interno usado para certificar"
                input_name="esquema"
                class="mt-2"
                @isset($competencia)
                current_value="{{$competencia->esquema}}"
                @endisset
            ></input-text>

            <input-checkbox
                class="mt-3"
                caption_text="¿Activo?"
                input_name="activo"
                @isset($competencia)
                    current_value="{{$competencia->activo}}"
                @endisset
                required="required"
            ></input-checkbox>

            <savecancel-btns
                back_url="{{url('/competencias')}}"
            ></savecancel-btns>
        </form>
    </div>     
@endsection