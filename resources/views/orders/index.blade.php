<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
    <div class="container mt-5">
        <h3>Historial de Ventas</h3>
        <a href="{{ route('menu') }}" class="btn btn-primary mb-3">Atrás</a>
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
