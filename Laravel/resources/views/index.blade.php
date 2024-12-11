@extends('layouts.base')

@section('title', 'Lista de Estudiantes')

@section('content')
<div class="container mt-4">
    <!-- Div para el botón con el ícono arriba del texto -->
    <div class="text-center mb-4">
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-lg" style="font-size: 30px";>
            <!-- Ícono encima del texto -->
            <i class="fa-solid fa-user-plus d-block" style="font-size: 50px;"></i>
            Añadir Estudiante
        </a>
        <!-- Botón para agregar materias -->
        <a href="{{ route('materias.create') }}" class="btn btn-success btn-lg" style="font-size: 30px">
            <i class="fa-solid fa-table-list d-block" style="font-size: 50px;"></i> Agregar Materia
        </a>
    </div>
<div class="col-10 mx-auto mt-5">
    <table class="table table-bordered text-dark mx-auto table-hover">
        <thead>
            <tr class="text-secondary">
                <th class="fs-5">Nombre</th>
                <th class="fs-5">Apellido</th>
                <th class="fs-5">Fecha de Nacimiento</th>
                <th class="fs-5">Clase</th>
                <th class="text-center fs-5">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
            <tr>
                <td class="fs-5">{{ $estudiante->nombre }}</td>
                <td class="fs-5">{{ $estudiante->apellido }}</td>
                <td class="fs-5">{{ $estudiante->fecha_nacimiento }}</td>
                <td class="fs-5">{{ $estudiante->clase->nombre ?? 'Sin clase'}}</td>
                <td class="text-center">
                    <!-- Boton para ver las notas y materias -->
                    <a href="{{ route('estudiantes.materias', $estudiante->id) }}" class="btn btn-info text-white"><i class="fa-solid fa-eye"></i> Ver Notas</a>
                    <!-- Botón Editar -->
                    <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                    <!-- Botón Eliminar con formulario -->
                    <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
