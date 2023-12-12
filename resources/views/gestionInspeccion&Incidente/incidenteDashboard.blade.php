@extends('layouts.app')
@section('tituloform', 'Incidente')
@section('content')
    @if (session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-10 border-left custom-form">
        <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav">
            <!-- indicador de la ubicacion actual en la pagina -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Incidentes</a></li>
            </ol>
        </nav>

        <div>
            <h4 class="mb-3">Incidentes</h4>
            <div id="Lista de botones">
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
                                data-bs-target="#consultaSeguimientosModal">
                                Consultar seguimientos de un proyecto e incidente
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#consultaIncidentesModal">
                                Consultar los incidentes e involucrados relacionados con un proyecto
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Consultar</a>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('reportar.incidente') }}">
                    <!-- Boton para agregar nuevos incidentes -->
                    <button class="btn btn-lg float-end custom-btn" type="submit" style="font-size: 15px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg> Reportar incidente
                    </button>
                </a>
            </div>

            <h1>Ultimos incidentes reportados</h1>

            <div class="table-responsive dataTables_wrapper dt-bootstrap5">

                <table id="Tabla_incidentes" class="table table-striped sticky-header">
                    <thead>
                        <tr>
                            <th scope="col">Incidente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Gravedad</th>
                            <th scope="col">Proyecto</th>
                            <th scope="col">Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidentes as $incidente)
                            <tr>
                                <td>
                                    {{ $incidente->incNombre }}
                                </td>
                                <td>
                                    {{ $incidente->incEstado }}
                                </td>
                                <td>
                                    {{ $incidente->incGravedad }}
                                </td>
                                <td>
                                    {{ optional($incidente)->proNombre }}
                                </td>
                                <td>
                                    {{ $incidente->incFecha }}
                                </td>
                                <td><button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item btn-desplegable-detalles" data-bs-toggle="modal"
                                                data-bs-target="#modalDetallesIncidente">Detalles</a></li>
                                        <li><a class="dropdown-item btn-desplegable-seguimiento" data-bs-toggle="modal"
                                                data-bs-target="#modalDetallesIncidente">Seguimiento</a></li>
                                        <li>
                                            <form
                                                action="{{ route('incidentes.destroy', ['id' => $incidente->pk_id_incidente]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    Quitar
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </li>
                                        <li><a href="{{ route('incidentes.edit', ['id' => $incidente->pk_id_incidente]) }}"
                                                class="dropdown-item btn-desplegable-Actualizar">Añadir seguimiento</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal para consultar seguimientos -->
    <div class="modal fade" id="consultaSeguimientosModal" tabindex="-1" aria-labelledby="consultaSeguimientosModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultaSeguimientosModalLabel">Consultar Seguimientos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar seguimientos -->
                    <form action="{{ route('incidentes.consultarSeguimientos') }}" method="post">
                        @csrf
                        <!-- Aquí coloca los campos que necesitas para la consulta de seguimientos -->
                        <div class="mb-3">
                            <label for="proyecto_nombre" class="form-label">Nombre del Proyecto</label>
                            <input type="text" class="form-control" id="proyecto_nombre" name="proyectoNombre"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="incidente_nombre" class="form-label">Nombre del Incidente</label>
                            <input type="text" class="form-control" id="incidente_nombre" name="incidenteNombre"
                                required>
                        </div>
                        <!-- Agrega más campos según sea necesario -->

                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para consultar incidentes e involucrados -->
    <div class="modal fade" id="consultaIncidentesModal" tabindex="-1" aria-labelledby="consultaIncidentesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultaIncidentesModalLabel">Consultar Incidentes e Involucrados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar incidentes e involucrados -->
                    <form>
                        <!-- Aquí coloca los campos que necesitas para la consulta -->
                        <div class="mb-3">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <input type="text" class="form-control" id="proyecto">
                        </div>
                        <!-- Agrega más campos según sea necesario -->

                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Agrega este script al final de tu vista para manejar el cierre del mensaje -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cerrar el mensaje cuando se haga clic en el botón
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.querySelector('.btn-close').addEventListener('click', function() {
                    successMessage.style.display = 'none';
                });
            }
        });
    </script>
@endsection
