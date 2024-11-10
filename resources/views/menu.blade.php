<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
</head>
<body class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
    
    <div class="todo" style="height: 50%; background:white; padding:10px; margin-left:80px; margin-right:80px; margin-top:20px; margin-bottom:0px; border-radius:20px;">
        <div class="text-start mt-3" style="padding-left:85px;padding-top:20px">
            <a href="{{ route('login') }}" class="btn btn-danger">
                Cerrar sesión
            </a>
        </div>
        <div class="container" style="display:flex;margin-top:60px;width:60%">

            <div class="container text-center p-4" style="height: 200px; width: 300px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin: 10px;">
                <h3>Punto de Venta</h3>
                <a href="{{ route('venta.index') }}" class="btn btn-primary mt-3" style="width:80%">
                    Ver
                </a>
            </div>
            <div class="container text-center p-4" style="height: 200px; width: 300px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin: 10px;">
                <h3>Productos</h3>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3" style="width:80%">
                    Ver
                </a>
            </div>
            <div class="container text-center p-4" style="height: 200px; width: 300px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin: 10px;">
                <h3>Empleados</h3>
                <a href="{{ route('employees.index') }}" class="btn btn-primary mt-3" style="width:80%">
                    Ver
                </a>
            </div>
        </div>
    </div>
</body>
</html>