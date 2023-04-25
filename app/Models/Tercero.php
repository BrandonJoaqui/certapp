<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    use HasFactory;
    protected $table = "terceros";
    protected $fillable = [
        "nombres",
        "apellidos",
        "tipo_de_documento",
        "nid",
        "telefono",
        "correo",
        "direccion",
        "fecha_nacimiento",
        "foto_carne",
    ];

    public function obtenerFotoCarne(){
        return mediaFile::find($this->foto_carne);
    }
}
