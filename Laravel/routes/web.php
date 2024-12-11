<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\NotaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('estudiantes', indexController::class);
Route::resource('notas',NotaController::class);
Route::resource('materias', MateriaController::class);

// Ruta para listar las notas y materias que tiene el estudiante
Route::get('/estudiantes/{id}/materias', [indexController::class, 'verMaterias'])->name('estudiantes.materias');


// Ruta para editar las notas con el id del estudiante
Route::get('/notas/{id}/edit', [NotaController::class, 'edit'])->name('notas.edit');

