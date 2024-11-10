<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
</head>
<body class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
    
    <div class="todo" style="align-items:center; display:flex; justify-content:center;background:white; padding:10px; margin-left:80px; margin-right:80px; margin-top:20px; margin-bottom:0px; border-radius:20px;">
         
        <div style="padding-top:20px;width:90%; padding-bottom:60px">
            <div class="text-start mt-3" style="padding-bottom:40px">
                <a href="{{ route('menu') }}" class="btn btn-primary">
                    Atrás
                </a>
            </div>

            <div>
                <h3>Lista de Productos</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Código</th>
                            <th>Stock</th>
                            <th>Mínimo</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td style="width: 30px">{{ $product->unitprice }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->stock }}</td>
                                <td style="width: 30px">{{ $product->stockmin }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td style="width: 100px;">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm" style="padding: 5px 10px;">
                                        <i class="fi fi-rr-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="padding: 5px 10px;">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end mt-3">
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="fi fi-rr-add"></i> Agregar Producto
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
