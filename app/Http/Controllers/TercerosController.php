<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero;

class TercerosController extends Controller
{
    public function index(Request $request){
        $Terceros = Tercero::where(function($qw) use ($request){
                        $qw = $qw->orWhere("nombres", "like", "%".$request->input("s")."%");
                        $qw = $qw->orWhere("apellidos", "like", "%".$request->input("s")."%");
                        $qw = $qw->orWhere("nid", "like", $request->input("s")."%");
                    });

        $Terceros = $Terceros
                    ->orderBy("created_at", "DESC")
                    ->paginate(15);

        if($request->ajax() || $request->has("json")){
            return $Terceros;
        }

        return view("terceros.index")->with([
            "terceros" => $Terceros,
        ]);
    }

    public function show($id){
        if(!$tercero = Tercero::find($id)){abort(404);};
        return $tercero;
    }

    public function edit($id){
        if(!$tercero = Tercero::find($id)){abort(404);};
        return view("terceros.createedit")->with([
            "tercero" => $tercero,
        ]);
    }

    public function create(){
        return view("terceros.createedit");
    }

    public function store(Request $request){
        $tercero = new Tercero();
        $tercero->fill($request->all());

        
            $tercero->save();
            try {
        } catch (\Throwable $th) {
            //echo $th;
            abort(403, "No se puede crear el recurso, error no especificado");
        }
            
        $tercero->fresh(); 
        
        return redirect("/terceros/".$tercero->id."/edit");
    }

    public function update($id, Request $request){
        if(!$tercero = Tercero::find($id)){abort(404);};
        $tercero->fill($request->all());

        try {
            $tercero->save();
        } catch (\Throwable $th) {
            abort(403, "No se puede editar el recurso, error no especificado. ");
        }
            
        return redirect("/terceros/".$tercero->id."/edit");
    }

    public function destroy($id, Request $request){
        if(!$tercero = Tercero::find($id)){abort(404);};
        $tercero->delete(); 
        return redirect("/terceros");
    }
    
}
