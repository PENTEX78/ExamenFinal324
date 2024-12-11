<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public $timestamps = false;  // Desactivar los timestamps
    use HasFactory;

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }

}
