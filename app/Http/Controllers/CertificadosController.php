<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use SimpleSoftwareIO\QrCode\Generator;

class CertificadosController extends Controller
{
    public function index(Request $request){
        $Certificados = Certificado::where(function($qw) use ($request){
                            $qw = $qw->orWhere("datos", "like", "%".$request->input("s")."%");
                        });

        $Certificados = $Certificados
                    ->orderBy("created_at", "DESC")
                    ->paginate(15);

        if($request->ajax() || $request->has("json")){
            return $Certificados;
        }

        return view("certificados.index")->with([
            "certificados" => $Certificados,
        ]);
    }

    public function show($id){
        if(!$Certificados = Certificado::find($id)){abort(404);};
        return $Certificados;
    }

    public function edit($id){
        if(!$Certificado = Certificado::find($id)){abort(404);};
        return view("certificados.createedit")->with([
            "certificado" => $Certificado,
        ]);
    }

    public function create(){
        return view("certificados.createedit");
    }

    public function store(Request $request){
        $Certificado = new Certificado();
        $Certificado->fill($request->all());

      
            $Certificado->save();
            try {
        } catch (\Throwable $th) {
            echo $th;exit;
            abort(403, "No se puede crear el recurso, error no especificado");
        }
        
        $Certificado->fresh(); 
        return redirect("/certificados/".$Certificado->id."/edit");
    }

    public function update($id, Request $request){
        if(!$Certificado = Certificado::find($id)){abort(404);};
        $Certificado->fill($request->all());

        try {
            $Certificado->save();
        } catch (\Throwable $th) {
            abort(403, "No se puede editar el recurso, error no especificado. ");
        }
            
        return redirect("/certificados/".$Certificado->id."/edit");
    }

    public function destroy($id, Request $request){
        if(!$Certificado = Certificado::find($id)){abort(404);};
        $Certificado->delete(); 
        return redirect("/certificados");
    }

    public function generarCarne($id){
        if(!$Certificado = Certificado::find($id)){abort(404);};
        $qrpath = storage_path('app/qr/'.$Certificado->id.'.png');
        $qrMergeImage = ('/storage/app/ic.png');

        $data   = 'https://sigmacertificamos.com/'.$Certificado->id;
        $from = [36, 161, 104];
        $to = [8, 13, 26];

        \QrCode::
         style('round')
         ->eye('circle')
         //->color(0, 0, 0, 100)
         ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
         ->merge($qrMergeImage)
         ->backgroundColor(255, 255, 255, 100)
         ->format('png')
         ->margin(0)
         ->size(500)
         ->generate($data, $qrpath);


        header('Content-type: image/jpeg');
      
        $templatePath = storage_path('app/carne_personas.jpg');

        //echo $templatePath;
        $image = new \Imagick($templatePath);
        $qrImage = new \Imagick($qrpath);
        $fotoImagen = new \Imagick($Certificado->obtenerPathImagenTercero());


        $qrImage->scaleImage(500,0);
        $image->compositeImage(
            $qrImage, 
            \imagick::COMPOSITE_DEFAULT, 
            2100, 950
        ); 

        $fotoImagen->scaleImage(380,0);
        $image->compositeImage(
            $fotoImagen, 
            \imagick::COMPOSITE_DEFAULT, 
            180, 460
        ); 


        /* Black text */
        $textBold = new \ImagickDraw();
        $textBold->setFillColor('#ffffff');
        $textBold->setFont(storage_path('app/semibold.ttf'));
        $textBold->setFontSize(55);

        /* normal text */
        $textNormal = new \ImagickDraw();
        $textNormal->setFillColor('#ffffff');
        $textNormal->setFont(storage_path('app/normal.ttf'));
        $textNormal->setFontSize(55);

        /* Create text */
        $image->annotateImage($textBold, 140, 1235, 0, $Certificado->obtenerTercero()->nombres);
        $image->annotateImage($textBold, 140, 1305, 0, $Certificado->obtenerTercero()->apellidos);
        $image->annotateImage($textNormal, 140, 1375, 0, 
            $Certificado->obtenerTercero()->tipo_de_documento." ".
            number_format($Certificado->obtenerTercero()->nid, 0, ",", ".")
        );

        
        $punteroYDescripcion =  330;
        
        $competenciaContainer = $this->wrapTextAndPrint(
            $image,
            strtoupper($Certificado->obtenerCompetencia()->descripcion),
            940, //x 
            $punteroYDescripcion , //y
            5,  //Sangria
            100, //size
            "#27272a", //color
            storage_path('app/extrabold.ttf'), //font
            1500 // maxWidth
        );

        $punteroYDescripcion =  $punteroYDescripcion + $competenciaContainer["height"];
        $tipoContainer = $this->wrapTextAndPrint(
            $image,
            "Tipo: ".($Certificado->tipo!=""?$Certificado->tipo:"N/A")
            ,
            940, //x 
            $punteroYDescripcion, //y
            5,  //Sangria
            70, //size
            "#5a5a63", //color
            storage_path('app/semibold.ttf'), //font
            1500 // maxWidth
        );

        $punteroYDescripcion += $tipoContainer["height"];
        if($Certificado->capacidad){
           $capacidadContainer = $this->wrapTextAndPrint(
                $image,
                "Capacidad: ".$Certificado->capacidad,
                940, //x 
                $punteroYDescripcion, //y
                5,  //Sangria
                70, //size
                "#5a5a63", //color
                storage_path('app/semibold.ttf'), //font
                1500 // maxWidth
            );
            $punteroYDescripcion = $punteroYDescripcion + $capacidadContainer["height"];
        }


        $codigoContainer = $this->wrapTextAndPrint(
            $image,
            "Código: ".$Certificado->consecutivo,
            940, //x 
            $punteroYDescripcion, //y
            5,  //Sangria
            70, //size
            "#5a5a63", //color
            storage_path('app/normal.ttf'), //font
            1500 // maxWidth
        );

        $punteroYDescripcion += $codigoContainer["height"];
        $codigoContainer = $this->wrapTextAndPrint(
            $image,
            "Norma: ".$Certificado->obtenerCompetencia()->normatividad,
            940, //x 
            $punteroYDescripcion, //y
            5,  //Sangria
            70, //size
            "#5a5a63", //color
            storage_path('app/normal.ttf'), //font
            1500 // maxWidth
        );

        
        /* Vencimiento */
        $this->wrapTextAndPrint(
            $image,
            "EXP: ".$Certificado->fecha_inicio.
            "  VEN: ".$Certificado->fecha_fin
            ,
            940, //x 
            1320, //y
            5,  //Sangria
            60, //size
            "#5a5a63", //color
            storage_path('app/semibold.ttf'), //font
            1500 // maxWidth
        );

         /* codigo sobre QR */
         $this->wrapTextAndPrint(
            $image,
            $Certificado->consecutivo,
            2120, //x
            850, //y
            5,  //Sangria
            60, //size
            "#26a26a", //color
            storage_path('app/extrabold.ttf'), //font
            1500 // maxWidth
        );


        echo $image;
    }

    private function wrapTextAndPrint(
        $image, 
        $text, 
        $x,
        $y, 
        $lineSpace,
        $fontSize,
        $fillColor,
        $fontPath,
        $maxWidth
    ){
        
        

        $draw = new \ImagickDraw();
        $draw->setFontSize($fontSize);
        $draw->setFillColor($fillColor);
        $draw->setFont($fontPath);

        $explodedText = explode(" ", $text);

        $lines = [];
        $i = 0;
        $height = 0;
        $newElementWidth = 0;
        foreach($explodedText as $word){
            $testText = ""; 
            if(empty($lines[$i])){
                //
                $testText = $word;
            }else{
                $testText = $lines[$i]." ".$word;
            }

            $textMetrics = $image->queryFontMetrics($draw, $testText);
            
            if($height < $textMetrics["textHeight"]){
                $height = $textMetrics["textHeight"];
            }

            if($textMetrics["textWidth"] < $maxWidth){
                if(empty($lines[$i])){ 
                    $lines[$i] = $word;
                }else{
                    $lines[$i] = $lines[$i]." ".$word;
                }
                
            }else{
                $i++;
                $lines[$i] = $word;
                if($newElementWidth < $textMetrics["textWidth"]){
                    $newElementWidth = $textMetrics["textWidth"];
                }
            }
        }

        foreach($lines as $k => $line){
            $lineYpos = $y + (($k+1)*$height); 
            $lineYpos = $k==0?$lineYpos:$lineYpos+$lineSpace;
            $image->annotateImage($draw, $x, $lineYpos, 0, $line);
        }

        return [
            "height" => (count($lines)*$height)+((count($lines)-1)*$lineSpace),
            "width" => $newElementWidth
        ];
        

    }

    public function consultaPublica(Request $request){
        if(!$request->has("tipo_de_consulta")){ return view("public.consultaCertificados"); }

        if($request->tipo_de_consulta == "consecutivo"){
            if(!$Certificado = Certificado::where("consecutivo", $request->consecutivo)->first()){
               return view("public.consultaCertificados")->with(["error"=>"No se ha encontrado el código proporcionado"]);
            }
            return view("public.consultaCertificados")->with([
                "certificado" => $Certificado,
            ]);
        }

        if($request->tipo_de_consulta == "persona"){
            $nid = str_replace(".", "", $request->nid);
            $nid = str_replace(",", "", $nid);
            
            $tercero = \App\models\Tercero::where("tipo_de_documento", $request->tipo_de_documento)
                        ->where("nid", $nid)
                        ->first();

            if(!$tercero){
                return view("public.consultaCertificados")->with(["error"=>"No se ha encontrado el documento proporcionado"]);
            }
            
            $Certificados = Certificado::where("tercero", $tercero->id)->paginate(10);

            return view("public.consultaCertificados")->with([
                "tipo" => "PERSONAS",
                "certificados" => $Certificados,
                "tercero" => $tercero,
            ]);
        }

        if($request->tipo_de_consulta == "equipo"){
            if($request->placa_serie == ""){
                return view("public.consultaCertificados")->with(["error"=>"No puede dejar espacios en blanco"]);
            }
            $equipo = \App\Models\Equipo::
                    orWhere("serie", $request->placa_serie)
                    ->orWhere("placa", $request->placa_serie)
                    ->first();
            if(!$equipo){
                return view("public.consultaCertificados")->with(["error"=>"No se ha encontrado placa o serie proporcionada"]);
            }
            $Certificados = Certificado::where("equipo", $equipo->id)->paginate(10);
            return view("public.consultaCertificados")->with([
                "tipo" => "EQUIPOS",
                "equipo" => $equipo, 
                "certificados" => $Certificados,
            ]);
        }
 
    }
}
