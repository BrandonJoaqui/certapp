<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;
    protected $table = "competencias";
    protected $fillable = [
        "descripcion",
        "ambito",
        "descripcion_corta",
        "normatividad",
        "esquema",
        "activo",
    ];
}
