<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Clase;
use Illuminate\Http\Request;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //retornamos la vista
        $estudiantes = Estudiante::with('clase')->get();
        return view('index', ['estudiantes' => $estudiantes]);
    }

    public function create()
    {
        $clases = Clase::all();
        //retornamos la vista del formulario para anadir estudiante
        return view('create', ['clases' => $clases]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        //recibimos la respuesta de la vista create y aplicamos la logica para almacenarlo en la base de datos
        Estudiante::create($request->all());
        return redirect()->route('estudiantes.index');
        //dd($request->all());
    }

    // funcion que permite direccionar a la vista donde muestra las notas
    public function verMaterias($id)
    {
        // Buscar estudiante por ID
        $estudiante = Estudiante::with('notas.materia')->findOrFail($id);

        // Pasar los datos a la vista
        return view('materias', ['estudiante' => $estudiante]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        $clases = Clase::all(); 
        //muestra el formulario para editar a los estudiantes
        return view('edit', ['clases' => $clases, 'estudiante'=> $estudiante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //hacemos la logica para actualizar datos
        $estudiante->update($request->all());
        return redirect()->route('estudiantes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        //eliminamos al estudiante 
        $estudiante->delete();
        return redirect()->route('estudiantes.index');
    }
}
