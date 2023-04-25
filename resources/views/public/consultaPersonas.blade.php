<div class="my-4" >
    La siguiente información, 
    corresponde al tercero 
    <b>{{$tercero->nombres}} {{$tercero->apellidos}}</b>
    identificado(a) con {{$tercero->tipo_de_documento}} no. {{number_format($tercero->nid,0,",",".")}}:
</div>
<div>
    <table class="table bg-white table-stripped w-100 rounded-1 shadow-lg" >
        <thead>
            <tr>
                <th>Código</th>
                <th>Ámbito</th>
                <th >Usuario</th>
                <th class="text-center" >Alcance</th>
                <th class="text-center" >Fechas</th>
                <th class="text-center" >Estado de la certificación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certificados as $certificado)
                <tr>
                    <td>{{$certificado->consecutivo}}</th>
                    <td>{{$certificado->obtenerCompetencia()->ambito}}</td>
                    <td>{{$certificado->obtenerTercero()->nombres}} <br> {{$certificado->obtenerTercero()->apellidos}}</td>
                    <td class="text-center" >
                        {{$certificado->obtenerCompetencia()->descripcion}} <br>
                        <b>Tipo:</b> {!!$certificado->tipo!=""?$certificado->tipo."<br>":"N/A<br>"!!}
                        <b>Capacidad:</b> {!!$certificado->capacidad!=""?$certificado->capacidad."<br>":"N/A<br>"!!}
                    </td>
                    <td class="text-center" >
                        Expedición: {{$certificado->fecha_inicio}} <br>
                        Vencimiento: {{$certificado->fecha_fin}} 
                    </td>
                    <th class="text-center" >{{$certificado->obtenerEstadoDeCertificado()}} </th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{$certificados->appends($_GET)->links()}}</div>
</div>


<div class="mt-5" >
    Recuerde que esta información corresponde a 
    lo almacenado en nuestra base de datos, 
    en caso de presentarse inconsistencias puede
    contactarse con nosotros atravez de nuestros 
    canales de atención.
</div>