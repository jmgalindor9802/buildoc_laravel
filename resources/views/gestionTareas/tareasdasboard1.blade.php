@extends('adminlte::page')
@section('content')
   

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" crossorigin="anonymous">
    
    <div class="col">
        <nav aria-label="breadcrumb" class=" align-items-center  ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Tareas</a></li>
            </ol>
        </nav>
        <div style="padding-right:5%">
            <h4 class="mb-3">Tareas </h4>
            <form id="formProyecto" method="post" action="Tareas_dashboard.php">
                <div class="dropdown float-end">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        style="background-color: transparent; border: none; color: black; fill: black;"
                        aria-expanded="false">
                        Filtros <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-funnel" viewBox="0 0 16 16">
                            <path
                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#consultaTareasModal">
                                Consultar tareas por fase y proyecto
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#consultaIncidentesModal">
                                Consultar los incidentes e involucrados relacionados con un proyecto
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="{{route('crear.tarea')}}"><button class=" btn-lg float-end btn btn-primary" type="button"
                        style="font-size: 15px; margin-right:1%">+ Crear
                        tarea</button></a>
                <a href="{{route('crear.fase')}}"><button class=" btn-lg float-end btn btn-primary" type="button"
                        style="font-size: 15px ;margin-right:1% ">+ Crear fase</button></a>
                <h1 class="display-6">Tareas próximas</h1>
                <div class="dropdown">

                </div>
            </form>
        </div>
        <div class="table-responsive vh-80 dataTables_wrapper dt-bootstrap5">
        <table id="tablaTareas" class="table table-striped sticky-header">
           
            <thead>
                <tr>
            <th class="col-2" scope="col">Proyecto</th>
            <th class="col-2" scope="col">Fase</th>
            <th class="col-3" scope="col">Tarea</th>
            <th class="col-2" scope="col">Fecha y Hora Límite</th>
            <th class="col-2" scope="col">Responsable</th>
            <th class="col-1" scope="col">Tiempo Restante</th>
            <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($tareas as $tarea)
                                <tr>
                                <td scope="row">{{ $tarea->fase->proyecto->proNombre ?? '' }}</td>
                                    <td scope="row">{{ $tarea->fase->fasNombre ?? '' }}</td>
                                    <td scope="row">{{ $tarea->tarNombre }}</td>
                                    <td scope="row">{{ \Carbon\Carbon::parse($tarea->tarFecha_limite)->format('j M Y') }}</td>
                                    <td scope="row">{{ $tarea->responsable->nombre_completo ?? '' }}</td>
                                    <td></td>
                                    <td scope="row">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a id="btn-desplegable-detalles" href="{{ route('tarea.edit', $tarea->pk_id_tarea) }}" class="dropdown-item">Actualizar</a></li>
                                                <li><a id="btn-desplegable-detalles" href="{{ route('tarea.show', $tarea->pk_id_tarea) }}" class="dropdown-item  text-danger">Eliminar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6a.5.5 0 0 0-.5-.5ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                        </svg></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                </tbody>
        </table>
        <hr>
        </div>
       
        <div class="row justify-content-center">
                {{ $tareas->links() }}
        </div>
    </div>
    <!-- Modal para consultar Tareas -->
    <div class="modal fade" id="consultaTareasModal" tabindex="-1" aria-labelledby="consultaTareasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultaTareasModalLabel">Consultar Tareas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar Tareas -->
                    <form action="{{ route('tareas.consultarTareas') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="proyecto_nombre" class="form-label">Nombre del Proyecto</label>
                            <select class="form-select" name="proyectoNombre" id="proyecto_nombre" required>
                                @foreach ($tareasConsultas as $tareasConsulta)
                                    <option value="{{ $tareasConsulta->nombre_proyecto }}">{{ $tareasConsulta->nombre_proyecto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="incidente_nombre" class="form-label">Fase</label>
                            <select class="form-select" name="FaseNombre" id="incidente_nombre" required>
                                @foreach ($tareasConsultas as $tareasConsulta)
                                    <option value="{{ $tareasConsulta->nombre_fase}}">{{ $tareasConsulta->nombre_fase}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                    <script>
                        // Manejar la carga dinámica de fases según el proyecto seleccionado
                        document.getElementById('proyecto_nombre').addEventListener('change', function() {
                            var proyectoSeleccionado = this.value;
                            var faseSelect = document.getElementById('fase_nombre');
                    
                            // Limpiar opciones actuales en el select de fases
                            while (faseSelect.firstChild) {
                                faseSelect.removeChild(faseSelect.firstChild);
                            }
                    
                            // Filtrar fases basadas en el proyecto seleccionado y agregar nuevas opciones
                            @foreach ($tareasConsultas as $tareasConsulta)
                                if ("{{ $tareasConsulta->nombre_proyecto }}" === proyectoSeleccionado) {
                                    var option = document.createElement('option');
                                    option.value = "{{ $tareasConsulta->nombre_fase }}";
                                    option.text = "{{ $tareasConsulta->nombre_fase }}";
                                    faseSelect.appendChild(option);
                                }
                            @endforeach
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@parent
    <!-- Agrega tus scripts personalizados aquí -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
@stop
