@extends('adminlte::page')

@section('title', 'Gestión de tareas')

@section('content_header')
    <h1>Gestión de tareas</h1>


@stop

@section('content')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            style="background-color: transparent; border: none; color: black; fill: black;" aria-expanded="false">
            Filtros <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-funnel" viewBox="0 0 16 16">
                <path
                    d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
            </svg>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#consultaTareasModal">
                    Listar tareas pendientes
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#TaresUsuarioProyecto">
                    Listar tareas por usuario y proyecto
                </a>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            @php
                $heads = [['label' => 'Proyecto'], 
                ['label' => 'Fase'], 
                ['label' => 'Tarea'], 
                ['label' => 'Descripción'], 
                ['label' => 'Fecha límite'], 
                ['label' => 'Acciones', 'no-export' => false, 'width' => 20],
            ];

                $config = [
                    'language' => [
                        'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    ]
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->fase->proyecto->proNombre }}</td>
                        <td>{{ $tarea->fase->fasNombre }}</td>
                        <td>{{ $tarea->tarNombre }}</td>
                        <td>{{ $tarea->tarDescripcion }}</td>
                        <td>{{ $tarea->tarFecha_limite }}</td>

                        <td>
                            <a href="{{ route('tarea.edit', $tarea->pk_id_tarea) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <a href="{{ route('tarea.show', $tarea->pk_id_tarea) }}"
                                class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>
                            {{-- Puedes agregar más botones de acciones aquí --}}
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
    <!-- Modal para consultar incidentes e involucrados -->
    <div class="modal fade" id="consultaTareasModal" tabindex="-1" aria-labelledby="consultaIncidentesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultaIncidentesModalLabel">Consultar tareas pendientes para la próxima semana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar incidentes e involucrados -->
                    <form action="{{ route('tareas.consultarTareasPendiente') }}" method="post">
                        @csrf
                        <!-- Aquí coloca los campos que necesitas para la consulta -->
                        <div class="mb-3">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select class="form-select" name="proyectoNombre" id="proyecto_nombre" required>
                                @foreach ($tareas as $tarea)
                                    <option value="{{ $tarea->fase->proyecto->pk_id_proyecto }}">
                                        {{ $tarea->fase->proyecto->proNombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Agrega más campos según sea necesario -->

                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para consultar incidentes e involucrados -->
    <div class="modal fade" id="TaresUsuarioProyecto" tabindex="-1" aria-labelledby="consultaIncidentesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultaIncidentesModalLabel">Consultar tareas pendientes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar incidentes e involucrados -->
                    <form action="{{ route('tareas.listaTareasUsuPro') }}" method="post">
                        @csrf
                        <!-- Aquí coloca los campos que necesitas para la consulta -->
                        <div class="mb-3">
                            <label for="proyecto" class="form-label">Usuario</label>
                            <select class="form-select" name="usuarioId" id="proyecto_nombre" required>
                                @foreach ($tareas as $tarea)
                                    @foreach ($tarea->usuariosGtTareas as $usuario)
                                        <option value="{{ $usuario->pk_id_usuario }}">{{ $usuario->nombreCompleto() }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select class="form-select" name="proyectoNombre" id="proyecto_nombre" required>
                                @foreach ($tareas as $tarea)
                                    <option value="{{ $tarea->fase->proyecto->proNombre }}">
                                        {{ $tarea->fase->proyecto->proNombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Agrega más campos según sea necesario -->

                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
@stop
