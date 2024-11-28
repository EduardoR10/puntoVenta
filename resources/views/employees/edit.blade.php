@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Empleado</h2>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $employee->lastname }}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="user" name="user" value="{{ $employee->user }}" required>
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $employee->phonenumber }}" required>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $employee->birthdate }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('employees.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection
