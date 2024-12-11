@extends('layouts.base')

@section('title', 'Ver Notas')

@section('content')
<div class="container">
    <h1>Materias y Notas de {{ $estudiante->nombre }} {{ $estudiante->apellido }}</h1>
    <table class="table table-bordered">
        <tr>
            <th>Materia</th>
            <th>Nota</th>
            <th>Fecha</th>
            <th class="text-center">Opciones</th>
        </tr>
        @foreach ($estudiante->notas as $nota)
        <tr>
            <td>{{ $nota->materia->nombre }}</td>
            <td>{{ $nota->id_nota }}</td>
            <td>{{ $nota->fecha }}</td>
            <td class="text-center">
                <!-- Botón para editar la nota -->
                <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-warning btn-sm text-white"><i class="fa-solid fa-pen"></i> Editar</a>
            </td>
        </tr>
        @endforeach
    </table>
    <!-- Botón centrado -->
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary btn-lg">Volver</a>
    </div>
</div>
@endsection
