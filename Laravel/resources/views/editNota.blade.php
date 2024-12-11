@extends('layouts.base')

@section('title', 'Editar Nota')

@section('content')
<div class="container">
    <h3>Editar Nota</h3>
    <form action="{{ route('notas.update', $nota->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="materia" class="form-label">Materia</label>
            <input type="text" class="form-control" id="materia" value="{{ $nota->materia->nombre }}" disabled>
        </div>

        <div class="mb-3">
            <label for="id_nota" class="form-label">Nota</label>
            <input type="number" class="form-control" id="id_nota" name="id_nota" value="{{ $nota->id_nota }}" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection
