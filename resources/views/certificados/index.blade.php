@extends('layouts.app')
@section('content')
    <div class="card-header">Certificados</div>
    <div class="card-body">
        <div class="contabit-model-actions my-4" >
            <a href="{{url('certificados/create')}}" class="btn btn-primary btn-sm" >
                <i class="fas fa-plus"></i> 
                Crear nuevo
            </a>
        </div>   
        @if(count($certificados) > 0)    
        <div id="vuetable">
            <simple-searchbar 
                @isset($_GET['s']) default_val="{{$_GET['s']}}" @endisset
            ></simple-searchbar>
            <table  class="table table-condensed table-bordered table-stripped" >
                <thead>
                    <tr>
                        <th>Acción</th>
                        <th  class="text-left">Descripción</th>
                        <th>Vigencia</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificados as $certificado)
                    <tr>
                        <td>
                            <action-btns
                                el_id="{{$certificado->id}}"
                                resources_url="{{url('certificados')}}"
                            >@csrf</action-btns>
                            @if($certificado->obtenerEstadoDeCertificado() != "Inactivo - faltan datos")
                                @if($certificado->obtenerCompetencia()->ambito == "PERSONAS")
                                    <div>
                                        <a 
                                            target="_blank" 
                                            href="/generar_carne/{{$certificado->id}}" 
                                            class="mt-1 btn btn-sm btn-info d-block" 
                                        >Carné</a>
                                        <a 
                                            target="_blank" 
                                            href="/generar_diploma/{{$certificado->id}}" 
                                            class="mt-1 btn btn-sm btn-info d-block" 
                                        >Diploma</a>
                                        <a 
                                            target="_blank"
                                            href="/consulta_certificados/?tipo_de_consulta=consecutivo&consecutivo={{$certificado->consecutivo}}" 
                                            class="mt-1 btn btn-sm btn-info d-block" 
                                        >Consulta web</a>
                                    </div>
                                @endif
                                @if($certificado->obtenerCompetencia()->ambito == "EQUIPOS")
                                    <div>
                                        <a 
                                            target="_blank" 
                                            href="/consulta_certificados/?tipo_de_consulta=consecutivo&consecutivo={{$certificado->consecutivo}}" 
                                            class="mt-1 btn btn-sm btn-info d-block" 
                                        >Certificado</a>
                                        <a 
                                            
                                            class="mt-1 btn btn-sm btn-info d-block" 
                                        >Consulta web</a>
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td class="text-left">
                            {!!$certificado->obtenerDescripcion()!!}
                        </td>
                        <td>
                            Desde: {{$certificado->fecha_inicio}} <br>
                            Hasta: {{$certificado->fecha_fin}} 
                        </td>
                        <td>{{$certificado->obtenerEstadoDeCertificado()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-5" >
            {{$certificados->appends($_GET)->links()}}
        </div>
        @else
        <div class="py-6 text-center" >
            <h3 class="text-3xl text-gray-600 pb-6" ><i class="fas fa-exclamation-circle"></i> Ops!</h3>
            <p>No se han encontrado datos en esta sección, intente crearlos pulsando el boton crear nuevo.</p>
        </div>
        @endif
    </div>
@endsection
