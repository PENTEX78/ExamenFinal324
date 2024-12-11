@extends('layouts.base')

@section('title', 'Agregar Materia')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Gestión de Materias</h1>

    {{-- Formulario para agregar materia --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form action="{{ route('materias.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nombre" class="form-label">Nombre de la Materia</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre de la materia" required>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Guardar Materia
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla para listar materias --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Listado de Materias</h2>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materias as $materia)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td class="text-center">
                            <form action="{{ route('materias.destroy', $materia) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

