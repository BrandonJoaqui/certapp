@extends('layouts.app')
@section('content')
    @isset($certificado)
        <div class="card-header">Editando certificado</div>
    @else
        <div class="card-header">Creando certificado</div>
    @endisset
    
    <div class="card-body">
        @isset($certificado)
        <form id="vueform" method="POST" action="{{url('/certificados/'.$certificado->id)}}">
            <input type="hidden" name="_method" value="PUT">
        @else
        <form id="vueform" method="POST" action="{{url('/certificados')}}">
        @endif
            @csrf
            <input-text
                caption_text="Consecutivo"
                placeholder_text="Ingrese número de consecutivo"
                required="true"
                input_name="consecutivo"
                @isset($certificado)
                current_value="{{$certificado->consecutivo}}"
                @endisset
            ></input-text>
            <tercero-selector
                class="mt-3"
                caption_text="Seleccione el tercero"
                placeholder_text="Seleccione el tercero"
                input_name="tercero"
                @isset($certificado)
                    current_value="{{$certificado->tercero}}"
                @endisset
                required="false"
            ></tercero-selector>
            <equipo-selector
                class="mt-3"
                caption_text="Seleccione equipo (Si aplica)"
                placeholder_text="Seleccione equipo"
                input_name="equipo"
                @isset($certificado)
                    current_value="{{$certificado->equipo}}"
                @endisset
                required="false"
            ></equipo-selector>
            <competencia-selector
                class="mt-3"
                caption_text="Seleccione la competencia"
                placeholder_text="Seleccione competencia"
                input_name="competencia"
                @isset($certificado)
                    current_value="{{$certificado->competencia}}"
                @endisset
                required="required"
            ></competencia-selector>
            <input-text
                class="mt-3"
                caption_text="Tipo"
                placeholder_text="Ingrese tipo"
                required="false"
                input_name="tipo"
                @isset($certificado)
                current_value="{{$certificado->tipo}}"
                @endisset
            ></input-text>
            <input-text
                class="mt-3"
                caption_text="Capacidad"
                placeholder_text="Ingrese capacidad"
                required="false"
                input_name="capacidad"
                @isset($certificado)
                current_value="{{$certificado->capacidad}}"
                @endisset
            ></input-text>
            <input-number
                class="mt-3"
                caption_text="Intensidad horaria"
                placeholder_text="Ingrese intensidad horaria si aplica"
                required="false"
                input_name="intensidad_horaria"
                @isset($certificado)
                current_value="{{$certificado->intensidad_horaria}}"
                @endisset
            ></input-number>
            
            <input-date
                class="mt-3"
                caption_text="Fecha de inicio de validez certificado"
                placeholder_text="Fecha de inicio"
                input_name="fecha_inicio"
                @isset($certificado)
                    current_value="{{$certificado->fecha_inicio}}"
                @endisset
                required="required"
            ></input-date>
            <input-date
                class="mt-3"
                caption_text="Fecha de fin de validez certificado"
                placeholder_text="Fecha de fin"
                input_name="fecha_fin"
                @isset($certificado)
                    current_value="{{$certificado->fecha_fin}}"
                @endisset
                required="required"
            ></input-date>
            <input-checkbox
                class="mt-3"
                caption_text="¿Certificado activo?"
                input_name="activo"
                @isset($certificado)
                    current_value="{{$certificado->activo}}"
                @endisset
                required="required"
            ></input-checkbox>

            <input-checkbox
                class="mt-3"
                caption_text="¿Puede el usuario descargar diploma en consulta pública?"
                input_name="permitir_descarga_publica_diploma"
                @isset($certificado)
                    current_value="{{$certificado->permitir_descarga_publica_diploma}}"
                @endisset
                required="required"
            ></input-checkbox>
            
            <savecancel-btns
                back_url="{{url('/certificados')}}"
            ></savecancel-btns>
        </form>
    </div>     
@endsection