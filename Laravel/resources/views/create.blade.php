@extends('layouts.base')

@section('title', 'Agregar Estudiante')

@section('content')

    <div class="col-5 mx-auto mt-4">
        <h3>Añadir Estudiante</h3>
        <form action="{{ route('estudiantes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="clase_id" class="form-label">Clase</label>
                <select class="form-select" id="clase_id" name="clase_id" required>
                    <option value="">Seleccionar Clase</option>
                    @foreach($clases as $clase)
                        <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success btn-lg">Agregar estudiante</button>
            </div>
        </form>
    </div>
