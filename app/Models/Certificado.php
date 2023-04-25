<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;
    
    protected $table = "certificados";
    protected $fillable = [
        "consecutivo",
        "tercero",
        "equipo",
        "competencia",
        "tipo",
        "capacidad",
        "activo", 
        "fecha_inicio",
        "fecha_fin",
    ];

    // ACTIVO - INACTIVO - SUSPENDIDO - EN PROCESO DE CERTIFICACIÓN
    public function obtenerEstadoDeCertificado(){
        $competencia = $this->obtenerCompetencia();

        if($competencia->ambito == "PERSONAS"){
            if(!$this->obtenerTercero()){
                return "Inactivo - faltan datos";
            }
        }

        if($competencia->ambito == "EQUIPOS"){
            if(!$this->obtenerEquipo()){
                return "Inactivo - faltan datos";
            }
        }

        $fechaInicio = strtotime($this->fecha_inicio." 00:00");
        $fechaFin = strtotime($this->fecha_fin." 23:59");
        $hoy = strtotime(date("Y-m-d H:i"));
        if(!$this->activo){
            return "Inactivo - suspendido";
        }
        if($hoy < $fechaInicio){
            return "En proceso de certificacion";
        }
        if($hoy >= $fechaInicio and $hoy <= $fechaFin){
            return "Activo";
        }
        if($hoy > $fechaFin){
            return "Inactivo - vencido";
        }
        return "unknown";
    }

    public function obtenerTercero(){
        $tercero = json_decode($this->datos)->tercero;
        return $tercero;
    }
    public function obtenerEquipo(){
        $equipo = json_decode($this->datos)->equipo;
        return $equipo;
    }
    public function obtenerCompetencia(){
        $competencia = json_decode($this->datos)->competencia;
        return $competencia;
    }
    public function obtenerDescripcion($separator = "<br>"){
        $competencia = $this->obtenerCompetencia();
        $tercero = $this->obtenerTercero();
       

        if($competencia->ambito == "PERSONAS"){
            $terceroNombres = "";
            if($tercero){
                $terceroNombres = $tercero->nombres." ".$tercero->apellidos;
            }
            
            return 
            $competencia->ambito.$separator.
            $competencia->descripcion_corta.$separator.
            $terceroNombres;
        }
        if($competencia->ambito == "EQUIPOS"){
            $terceroNombres = "";
            if($tercero){
                $terceroNombres = $tercero->nombres." ".$tercero->apellidos.$separator;
            }
            $equipo = $this->obtenerEquipo();
            $EquipoPlacaSerie = "";
            if($equipo){
                $EquipoPlacaSerie = $equipo->placa." ".$equipo->serie;
            }
            return 
            $competencia->ambito.$separator.
            $competencia->descripcion_corta.$separator.
            $terceroNombres.
            $EquipoPlacaSerie;
        }
        return "unknown";
    }

    public function save(array $options = array()){
        $this->datos = json_encode([
            "tercero" => Tercero::find($this->tercero),
            "equipo" => Equipo::find($this->equipo),
            "competencia" => Competencia::find($this->competencia),
        ]);
        return parent::save();
    }

    public function obtenerPathImagenTercero(){
        $imageObj = Tercero::find($this->tercero)->obtenerFotoCarne();
        return \Storage::disk('mediafiles_storage')->path($imageObj->path);

    }
}
