@extends('layouts.hojaCarta')
@section("title"){{$certificado->consecutivo}}@endsection
@section('content')
        <table class="table table-bordered table-sm table-condensed w100" >
            <tr>
                <td><img class="odc_logo" src="{{url('/assets/odc_logo.png')}}"></td>
                <td colspan="2" class="h2 pt-3" >CERTIFICADO</td>
            </tr>
            <tr class="font-small" >
                <td >Código: {{$certificado->consecutivo}}</td>
                <td>Versión. 1</td>
                <td>Fecha: {{$certificado->fecha_inicio}}</td>
            </tr>
        </table>
        <div class="mt-5 h1" >
            {{$certificado->obtenerTercero()->nombres}} 
            {{$certificado->obtenerTercero()->apellidos}}
        </div>
        <div class="p-0 h3" >
            {{$certificado->obtenerTercero()->tipo_de_documento}}: 
            {{number_format($certificado->obtenerTercero()->nid,0,",",".")}} 
        </div> 
        <div class="mt-2" >
            Ha demostrado habilidad, experiencia y responsabilidad en la competencia: 
        <div>
        
        <div class="my-4 text-mayus h2">{{$certificado->obtenerCompetencia()->descripcion}}</div>
            
        <div  >Cumpliendo con 
            los procedimientos de seguridad establecidos. Ha aprobado el curso con una duración de 
            ({{$certificado->intensidad_horaria}}) horas, bajo el referente normativo 
            <b>{{$certificado->obtenerCompetencia()->normatividad}}</b>, por lo cual se considera altamente 
            capacitado y apto para desempeñarse como: {{$certificado->obtenerCompetencia()->descripcion}}
        </div>

        <div class="my-2" >Otorgado el día <b>{{$certificado->obtenerFechaInicioCertificadoFormateada()}}</b> </div>

        <table class="tablas-firmas" >
            <tbody>
                <tr>
                    <td class="contenedores-firma contenedores-firma-img" >
                        <img src="{{url('/assets/firma_1.png')}}">

                    </td>
                    <td></td>
                    <td class="contenedores-firma contenedores-firma-img" > 
                        <img src="{{url('/assets/firma_2.png')}}">
                    </td>
                </tr>
                <tr>
                    <td class="contenedores-firma" >
                        <hr>
                        <div class="mt-1 pt-2 text-mayus" >Ana Lucia Peña Ospina</div>
                        <div class="font-small" ><b>Gerente general</b></div>
                    </td>
                    <td></td>
                    <td class="contenedores-firma" > 
                        <hr>
                        <div class="mt-1 pt-2 text-mayus" >Diego Alfaro Quintero Loaiza</div>
                        <div class="font-small" ><b>Director técnico</b></div>
                    </td>
                </tr>
            </tbody>
        </table>


        <div class="footer pb-4 pt-2 font-small" >
            <div><b>SIGMA CERTIFICAMOS E&P S.A.S - NIT 901.520.156-1</b></div>
            <div>Cl 48 # 25-A13 Barrio Altamira - Tel. 602 269 8226 | 312 805 7875</div>
            <div>Palmira - Valle del Cauca</div>
            <div>SIGMACERTIFICAMOS.COM - contacto@sigmacertificamos.com</div>
        </div>
@endsection