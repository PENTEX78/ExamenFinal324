<?php

namespace App\Http\Controllers;
use App\Models\Materia;

use Illuminate\Http\Request;

class MateriaController extends Controller
{
    // Funcion para retornar la vista con las materias
    public function create()
    {
        $materias = Materia::all();
        //retornamos la vista del formulario para anadir materia
        return view('createMateria', ['materias' => $materias]);
    }

    // Funcion para guardar la materia en la base de datos
    public function store(Request $request) 
    {
        //recibimos la respuesta de la vista create y aplicamos la logica para almacenarlo en la base de datos
        Materia::create($request->all());
        return redirect()->route('materias.create');
        //dd($request->all());
    }

    // Funcion para eliminar la materia
    public function destroy(Materia $materia)
    {
        //eliminamos al estudiante 
        $materia->delete();
        return redirect()->route('materias.create');
    }
}
