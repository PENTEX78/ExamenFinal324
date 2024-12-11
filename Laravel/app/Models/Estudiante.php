<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public $timestamps = false;  // Desactivar los timestamps

    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'clase_id'];

    // Son las relaciones que se tiene con la tabla notas
    public function notas()
    {
        return $this->hasMany(Nota::class, 'id_estudiante');
    }
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'clase_id');
    }

}

