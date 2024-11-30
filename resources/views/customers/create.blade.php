@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container mt-5">
    <h2>Agregar Nuevo Cliente</h2>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="contactname" class="form-label">Nombre de Contacto</label>
            <input type="text" class="form-control" id="contactname" name="contactname" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="phonenumber" name="phonenumber" required pattern="[0-9]{10}">
            <small class="form-text text-muted">Formato: 1234567890</small>
        </div>
        <div class="mb-3">
            <label for="razonsocial" class="form-label">Razón Social</label>
            <input type="text" class="form-control" id="razonsocial" name="razonsocial" required>
        </div>
        <div class="mb-3">
            <label for="regimenfiscal" class="form-label">Régimen Fiscal</label>
            <input type="text" class="form-control" id="regimenfiscal" name="regimenfiscal" required>
        </div>
        <div class="mb-3">
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" class="form-control" id="rfc" name="rfc" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('customers.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection
