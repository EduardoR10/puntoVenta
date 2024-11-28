@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Cliente</h2>
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="contactname" class="form-label">Nombre de Contacto</label>
            <input type="text" class="form-control" id="contactname" name="contactname" value="{{ $customer->contactname }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $customer->city }}" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ $customer->country }}" required>
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{ $customer->phonenumber }}" required>
        </div>
        <div class="mb-3">
            <label for="razonsocial" class="form-label">Razón Social</label>
            <input type="text" class="form-control" id="razonsocial" name="razonsocial" value="{{ $customer->razonsocial }}" required>
        </div>
        <div class="mb-3">
            <label for="regimenfiscal" class="form-label">Régimen Fiscal</label>
            <input type="text" class="form-control" id="regimenfiscal" name="regimenfiscal" value="{{ $customer->regimenfiscal }}" required>
        </div>
        <div class="mb-3">
            <label for="rfc" class="form-label">RFC</label>
            <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $customer->rfc }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('customers.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection
