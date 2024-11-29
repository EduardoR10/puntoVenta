<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte Trimestral de Ventas por Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100" style="width:100%;background: linear-gradient(to bottom, #e60120, #f16676); margin-bottom: 30px;">
    <div class="container mt-5" style="width:90%;height: 100%; background:white; padding:50px; margin: 0px auto 0 auto; border-radius:20px;">
        <div style="height:90%; width:100%; padding-bottom:60px">
            <div class="text-start mt-3" style="padding-bottom:20px; padding-left:10px; position: relative; display: flex; flex-direction: column; align-items: center;">
                <a href="{{ route('menu') }}" class="btn btn-primary" style="background:#fab110; border: 0.5px solid #fab110; align-self: flex-start;">
                    Atrás
                </a>
                <h3>Reporte Trimestral de Ventas por Empleado</h3>
            </div>

            <form method="GET" action="{{ route('ventas_trimestrales.index') }}" class="mb-4">
                <div class="row g-3 align-items-center">
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
                        <button style="width:10%;background:#fab110; border: 0.5px solid #fab110;" type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>

            @if ($reports->isEmpty())
                <div class="alert alert-info text-center">
                    No se encontraron reportes para el año seleccionado.
                </div>
            @else
                <table class="table table-bordered bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Empleado</th>
                            <th>Trimestre 1</th>
                            <th>Trimestre 2</th>
                            <th>Trimestre 3</th>
                            <th>Trimestre 4</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->employee_name }}</td>
                                <td>{{ $report->q1_sales }}</td>
                                <td>{{ $report->q2_sales }}</td>
                                <td>{{ $report->q3_sales }}</td>
                                <td>{{ $report->q4_sales }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $reports->appends(['year' => request('year')])->links('pagination::bootstrap-4') }}
                </div>

            @endif
        </div>
    </div>
</body>
</html>
