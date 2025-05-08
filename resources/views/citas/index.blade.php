<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #0d47a1, #000000);
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 60px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }

        .btn-dashboard {
            margin-bottom: 20px;
            background-color: #2196f3;
            border: none;
        }

        .btn-dashboard:hover {
            background-color: #1976d2;
        }

        table {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}" class="btn btn-dashboard text-white">← Volver al Dashboard</a>
        <h2 class="mb-4">Mis Citas Agendadas</h2>

        @if ($citas->isEmpty())
            <div class="alert alert-info bg-dark text-white border-white">No tienes citas agendadas aún.</div>
        @else
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Dependencia</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td>{{ $cita->nombre }}</td>
                            <td>{{ $cita->dependencia }}</td>
                            <td>{{ $cita->descripcion }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
