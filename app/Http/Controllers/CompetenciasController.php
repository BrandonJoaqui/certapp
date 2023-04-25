<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competencia;

class CompetenciasController extends Controller
{
     public function index(Request $request){
        $Competencias = Competencia::where(function($qw) use ($request){
                        $qw = $qw->orWhere("descripcion", "like", "%".$request->input("s")."%");
                        $qw = $qw->orWhere("descripcion_corta", "like", "%".$request->input("s")."%");
                    });

        $Competencias = $Competencias
                    ->orderBy("created_at", "DESC")
                    ->paginate(15);

        if($request->ajax() || $request->has("json")){
            return $Competencias;
        }

        return view("competencias.index")->with([
            "competencias" => $Competencias,
        ]);
    }

    public function show($id){
        if(!$Competencia = Competencia::find($id)){abort(404);};
        return $Competencia;
    }

    public function edit($id){
        if(!$Competencia = Competencia::find($id)){abort(404);};
        return view("competencias.createedit")->with([
            "competencia" => $Competencia,
        ]);
    }

    public function create(){
        return view("competencias.createedit");
    }

    public function store(Request $request){
        $Competencia = new Competencia();
        $Competencia->fill($request->all());

        try {
            $Competencia->save();
        } catch (\Throwable $th) {
            //echo $th;
            abort(403, "No se puede crear el recurso, error no especificado");
        }
        
        $Competencia->fresh(); 
        return redirect("/competencias/".$Competencia->id."/edit");
    }

    public function update($id, Request $request){
        if(!$Competencia = Competencia::find($id)){abort(404);};
        $Competencia->fill($request->all());

        try {
            $Competencia->save();
        } catch (\Throwable $th) {
            abort(403, "No se puede editar el recurso, error no especificado. ");
        }
            
        return redirect("/competencias/".$Competencia->id."/edit");
    }

    public function destroy($id, Request $request){
        if(!$Competencia = Competencia::find($id)){abort(404);};
        $Competencia->delete(); 
        return redirect("/competencias");
    }

}
