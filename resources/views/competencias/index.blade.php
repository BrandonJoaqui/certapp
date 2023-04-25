@extends('layouts.app')
@section('content')
    <div class="card-header">Competencias</div>
    <div class="card-body">
        <div class="contabit-model-actions my-4" >
            <a href="{{url('competencias/create')}}" class="btn btn-primary btn-sm" >
                <i class="fas fa-plus"></i> 
                Crear nuevo
            </a>
        </div>   
        @if(count($competencias) > 0)    
        <div id="vuetable">
            <simple-searchbar 
                @isset($_GET['s']) default_val="{{$_GET['s']}}" @endisset
            ></simple-searchbar>
            <table  class="table table-condensed table-bordered table-stripped" >
                <thead>
                    <tr>
                        <th>Acción</th>
                        <th  class="text-left">Descripcion</th>
                        <th>Norma</th>
                        <th>Esquema</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($competencias as $competencia )
                    <tr>
                        <td>
                            <action-btns
                                el_id="{{$competencia->id}}"
                                resources_url="{{url('competencias')}}"
                            >@csrf</action-btns>
                        </td>
                        <td class="text-left">
                            {{$competencia->descripcion_corta}}
                        </td>
                        <td>{{$competencia->normatividad}}</td>
                        <td>{{$competencia->esquema}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-5" >
            {{$competencias->appends($_GET)->links()}}
        </div>
        @else
        <div class="py-6 text-center" >
            <h3 class="text-3xl text-gray-600 pb-6" ><i class="fas fa-exclamation-circle"></i> Ops!</h3>
            <p>No se han encontrado datos en esta sección, intente crearlos pulsando el boton crear nuevo.</p>
        </div>
        @endif
    </div>
@endsection
