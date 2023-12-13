@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido a BuilDoc.</p>
    <div>
        <div class="col-6">
            <canvas id="myChartTareas"></canvas>
        </div>

        <div class="col-6">
            <canvas id="myChartUsuarios"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Gráfica de Tareas por Proyecto
            var proyectosTareas = @json($proyectosConTareas);
            var numeroDeTareas = @json($numeroDeTareas);

            const ctxTareas = document.getElementById('myChartTareas');

            new Chart(ctxTareas, {
                type: 'bar',
                data: {
                    labels: proyectosTareas,
                    datasets: [{
                        label: 'Número de Tareas',
                        data: numeroDeTareas,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfica de Usuarios por Proyecto
            // Gráfica de Usuarios por Proyecto
            var proyectosUsuarios = @json($proyectos);
            var cantidadUsuarios = @json($cantidadUsuarios);

            const ctxUsuarios = document.getElementById('myChartUsuarios');

            new Chart(ctxUsuarios, {
                type: 'bar',
                data: {
                    labels: proyectosUsuarios,
                    datasets: [{
                        label: 'Número de Usuarios',
                        data: cantidadUsuarios,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
