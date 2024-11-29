@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Producto</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}" required>
        </div>

        <div class="mb-3">
            <label for="unitprice" class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" class="form-control" id="unitprice" name="unitprice" value="{{ $product->unitprice }}" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $product->code }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
        </div>

        <div class="mb-3">
            <label for="stockmin" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="stockmin" name="stockmin" value="{{ $product->stockmin }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($product->image)
                <p class="mt-2">Imagen actual: <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del producto" style="width: 100px;"></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('products.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection
