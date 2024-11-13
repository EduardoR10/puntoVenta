<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100" style="width:100%;background: linear-gradient(to bottom, #e60120, #f16676); margin-bottom: 30px;">
    <div class="container mt-5" style="width:90%;height: 90%; background:white; padding:50px; margin: 0px auto 0 auto; border-radius:20px;">
    <div style="width:100%; padding-bottom:60px">
        <div class="text-start mt-3" style="padding-bottom:20px; padding-left:10px; position: relative; display: flex; flex-direction: column; align-items: center;">
    
            <a href="{{ route('menu') }}" class="btn btn-primary" style="background:#fab110; border: 0.5px solid #fab110; align-self: flex-start;">
                Atrás
            </a>
            <h3>Historial de Ventas</h3>
        </div>

        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Número de Orden</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <a>
                                <strong>{{ $order->id }}</strong>
                            </a>
                            <a href="{{ route('orders.show', $order->id) }}">
                                VER
                        </td>
                        <td>{{ $order->orderdate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
