@extends('adminlte::page')
@section('tituloform', 'Incidente')
@section('content')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" crossorigin="anonymous">
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

            <a href="{{ route('reportar.incidente') }}">
                <!-- Boton para agregar nuevos incidentes -->
                <button class="btn btn-lg float-end custom-btn" type="submit" style="font-size: 15px;"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg> Reportar
                    incidente
                </button></a>

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
                                                class="dropdown-item btn-desplegable-Actualizar">Añadir seguimiento</a></li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
@section('js')
    <!-- Agrega tus scripts personalizados aquí -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
@stop