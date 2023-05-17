<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquiposController extends Controller
{
    public function index(Request $request){
        $Equipos = Equipo::where(function($qw) use ($request){
                        $qw = $qw->orWhere("placa", "like", "%".$request->input("s")."%");
                        $qw = $qw->orWhere("serie", "like", "%".$request->input("s")."%");
                    });

        $Equipos = $Equipos
                    ->orderBy("created_at", "DESC")
                    ->paginate(15);

        if($request->ajax() || $request->has("json")){
            return $Equipos;
        }

        return view("equipos.index")->with([
            "equipos" => $Equipos,
        ]);
    }

    public function show($id){
        if(!$Equipo = Equipo::find($id)){abort(404);};
        return $Equipo;
    }

    public function edit($id){
        if(!$Equipo = Equipo::find($id)){abort(404);};
        return view("equipos.createedit")->with([
            "equipo" => $Equipo,
        ]);
    }

    public function create(){
        return view("equipos.createedit");
    }

    public function store(Request $request){
        $equipo = new Equipo();
        $equipo->fill($request->all());

        try {
            $equipo->save();
        } catch (\Throwable $th) {
            //echo $th;
            abort(403, "No se puede crear el recurso, error no especificado");
        }
        
        $equipo->fresh(); 
        return redirect("/equipos/".$equipo->id."/edit");
    }

    public function update($id, Request $request){
        if(!$equipo = Equipo::find($id)){abort(404);};
        $equipo->fill($request->all());

        try {
            $equipo->save();
        } catch (\Throwable $th) {
            abort(403, "No se puede editar el recurso, error no especificado. ");
        }
            
        return redirect("/equipos/".$equipo->id."/edit");
    }

    public function destroy($id, Request $request){
        if(!$equipo = Equipo::find($id)){abort(404);};
        $equipo->delete(); 
        return redirect("/equipos");
    }


}
