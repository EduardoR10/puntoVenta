@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container mt-5">
    <h2>Agregar Nuevo Empleado</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="user" name="user" required>
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="phonenumber" name="phonenumber" required pattern="[0-9]{10}">
            <small class="form-text text-muted">Formato: 1234567890</small>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group mb-4">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text">
                    <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;" aria-label="Mostrar contraseña"></i>
                </span>
            </div>
        </div>
        <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");

            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                this.classList.toggle("fa-eye-slash");
            });
        </script>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('employees.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection
