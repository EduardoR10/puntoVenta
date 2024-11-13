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
<body class="vh-100" style="background: linear-gradient(to bottom, #e60120, #f16676); background-size: cover; background-attachment: fixed; margin-bottom: 30px;">
    
    <div class="todo" style="height: 80%; background:white; padding:10px; margin-left:80px; margin-right:80px; margin-top:20px; margin-bottom:0px; border-radius:20px;">
        <div class="text-start mt-3" style="padding-left:85px;padding-top:20px; position: relative;">
            <a href="{{ route('login') }}" class="btn btn-danger">
                Cerrar sesión
            </a>
            <img src="{{ asset('img/OKSO.png') }}" style="width:150px; height:75px; margin-bottom: 1em; margin-right: 85px; position: absolute; top: 0; right: 0;">
        </div>

        <div class="container" style="display:flex;margin-top:60px;width:80%">

            <div class="container text-center p-4" style="height: 250px; width: 400px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin: 20px;">
                <h3>Punto de Venta</h3>
                <img src="{{ asset('img/punto-de-venta.png') }}" alt="" style="width:70px; height:70px;">
                <a href="{{ route('venta.index') }}" class="btn btn-primary mt-3" style="width:80%; background:#fab110; border: 0.5px solid #fab110;">
                    Ver
                </a>
            </div>
            <div class="container text-center p-4" style="height: 250px; width: 400px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin: 20px;">
                <h3>Productos</h3>
                <img src="{{ asset('img/carrito-de-supermercado.png') }}" alt="" style="width:70px; height:70px; margin-bottom:16.5px; margin-top:16.5px;">
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3" style="width:80%; background:#fab110; border: 0.5px solid #fab110;">
                    Ver
                </a>
            </div>
            <div class="container text-center p-4" style="height: 250px; width: 400px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1); border-radius: 20px; margin: 20px;">
                <h3>Empleados</h3>
                <img src="{{ asset('img/redes.png') }}" alt="" style="width:70px; height:70px; margin-bottom:16.5px; margin-top:16.5px;">
                <a href="{{ route('employees.index') }}" class="btn btn-primary mt-3" style="width:80%; background:#fab110; border: 0.5px solid #fab110;">
                    Ver
                </a>
            </div>
        </div>
    </div>
</body>
</html>