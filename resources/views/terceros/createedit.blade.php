@extends('layouts.app')
@section('content')
    @isset($tercero)
        <div class="card-header">Editando tercero</div>
    @else
        <div class="card-header">Creando tercero</div>
    @endisset
    
    <div class="card-body">
        @isset($tercero)
        <form id="vueform" method="POST" action="{{url('/terceros/'.$tercero->id)}}">
            <input type="hidden" name="_method" value="PUT">
        @else
        <form id="vueform" method="POST" action="{{url('/terceros')}}">
        @endif
            @csrf
        

            <input-text
                caption_text="Nombres"
                placeholder_text="Ingrese nombres"
                required="true"
                input_name="nombres"
                @isset($tercero)
                current_value="{{$tercero->nombres}}"
                @endisset
            ></input-text>

            <input-text
                caption_text="Apellidos"
                placeholder_text="Ingrese apellidos"
                required="false"
                class="mt-2"
                input_name="apellidos"
                @isset($tercero)
                current_value="{{$tercero->apellidos}}"
                @endisset
            ></input-text>

            <input-selector
                caption_text="Tipo de documento"
                placeholder_text="seleccione el tipo de documento"
                required="true"
                class="mt-2"
                input_name="tipo_de_documento"
                :input_values="['CC', 'CE', 'PPT', 'PASAPORTE']"
                @isset($tercero)
                current_value="{{$tercero->tipo_de_documento}}"
                @endisset
            ></input-selector>
           
            
            <input-text
                caption_text="Número de identificación"
                placeholder_text="Ingrese el valor"
                required="true"
                class="mt-2"
                input_name="nid"
                @isset($tercero)
                current_value="{{$tercero->nid}}"
                @endisset
            ></input-text>


            <input-text
                caption_text="Teléfono principal"
                placeholder_text="Ingrese el valor"
                input_name="telefono"
                class="mt-2"
                @isset($tercero)
                current_value="{{$tercero->telefono}}"
                @endisset
            ></input-text>
            
            <input-text
                caption_text="Correo electrónico"
                class="mt-2"
                placeholder_text="Correo para notificaciones y factura electrónica"
                input_name="correo"
                @isset($tercero)
                current_value="{{$tercero->correo}}"
                @endisset
            ></input-text>

            <input-text
                caption_text="Dirección de residencia"
                class="mt-2"
                placeholder_text="Dirección de residencia"
                input_name="direccion"
                @isset($tercero)
                current_value="{{$tercero->direccion}}"
                @endisset
            ></input-text>
            <input-date
                caption_text="Fecha de nacimiento"
                class="mt-2"
                placeholder_text="Fecha de nacimiento"
                input_name="fecha_nacimiento"
                @isset($tercero)
                current_value="{{$tercero->fecha_nacimiento}}"
                @endisset
            ></input-date>

            <input-file
                caption_text="Foto para carné"
                input_name="foto_carne"
                accept="image/x-png,image/gif,image/jpeg"
                @isset($tercero)
                current_value="{{$tercero->foto_carne}}"
                @endisset
            ></input-file>

           
            <savecancel-btns
                back_url="{{url('/terceros')}}"
            ></savecancel-btns>
        </form>
    </div>     
@endsection