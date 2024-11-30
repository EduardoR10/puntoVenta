<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100" style="width:100%;background: linear-gradient(to bottom, #e60120, #f16676); margin-bottom: 20px;">
    <div class="container mt-5" style="width:90%;height: 100%; background:white; padding:50px; margin: 0px auto 0 auto; border-radius:20px;">
        <div style="height:90%; width:100%; padding-bottom:0px">
            <div class="text-start mt-3" style="padding-bottom:0px; padding-left:10px; position: relative; display: flex; flex-direction: column; align-items: center;">
                <a href="{{ route('menu') }}" class="btn btn-primary" style="background:#fab110; border: 0.5px solid #fab110; align-self: flex-start;">
                    Atrás
                </a>
                <h3>Reporte de Ventas</h3>
            </div>

            <form method="GET" action="{{ route('ventas_mes.index') }}" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="month" class="form-label">Mes</label>
                        <select id="month" name="month" class="form-select">
                            <option value="">Seleccione un mes</option>
                            @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="year" class="form-label">Año</label>
                        <select id="year" name="year" class="form-select">
                            <option value="">Seleccione un año</option>
                            @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="">
                        <button style="width:10%;background:#fab110; border: 0.5px solid #fab110; align-self: flex-start;" type="submit" class="btn btn-primary ">Filtrar</button>
                    </div>
                </div>
            </form>

            @if ($orders->isEmpty())
                <div class="alert alert-info text-center">
                    No se encontraron órdenes para los filtros seleccionados.
                </div>
            @else
                <table class="table table-bordered bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Número de Orden</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Empleado</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->orderdate }}</td>
                                <td>{{ $order->customer->razonsocial }}</td>
                                <td>{{ $order->employee->name }} {{ $order->employee->lastname }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $orders->appends(['month' => request('month'), 'year' => request('year')])->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
