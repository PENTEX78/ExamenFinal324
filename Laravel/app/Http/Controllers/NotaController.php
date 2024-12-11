<?php

namespace App\Http\Controllers;
use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    // funcion para llamar a la vista de editar nota
    public function edit($id)
    {
        $nota = Nota::with('materia')->findOrFail($id);
        return view('editNota', ['nota' => $nota]);
    }

    // funcion para editar y realizar la consulta en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_nota' => 'required|numeric|min:0|max:100',
        ]);

        $nota = Nota::findOrFail($id);
        $nota->id_nota = $request->id_nota;
        $nota->save();

        return redirect()->route('estudiantes.materias', $nota->id_estudiante);
    }


}
