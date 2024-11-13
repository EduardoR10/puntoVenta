<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #fff; font-family: monospace; padding: 20px;">
    <div class="container">
        <div class="text-start mt-3" style="padding-bottom:40px">
                <a href="{{ route('orders.index') }}" class="btn btn-primary">
                    Atrás
                </a>
        </div>
        <h3 class="text-center">OKSO</h3>
        <p class="text-center">Ticket de Venta</p>
        <p><strong>Número de Orden:</strong> {{ $order->id }}</p>
        <p><strong>Fecha:</strong> {{ $order->orderdate }}</p>
        <p><strong>Empleado:</strong> {{ $order->employee->name }} {{ $order->employee->lastname }}</p>

        <h5>Artículos</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->unitprice, 2) }}</td>
                        <td>${{ number_format($detail->quantity * $detail->unitprice, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
        <p><strong>IVA:</strong> ${{ number_format($order->iva, 2) }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
    </div>
</body>
</html>
