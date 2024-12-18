<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $timestamps = false;  // Desactivar los timestamps
    protected $fillable = ['nombre'];
    use HasFactory;
}
