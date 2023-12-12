@extends('adminlte::page')
@section('tituloform', 'Seguimiento')
@section('content')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" crossorigin="anonymous">
    <div class="col-12 border-left ">
        <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Incidente</a></li>
                <li class="breadcrumb-item active" aria-current="page">Seguimiento</li>
            </ol>
        </nav>
        <div class="col-12 custom-form vh-80">
            <br>

            <form action="{{ route('incidentes.update', ['id' => $incidente->pk_id_incidente]) }}" method="POST" class="needs-validation " style="max-height: 70vh" novalidate>
                @method('PUT')
                @csrf
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label id="NombreProyecto" for="firstName" class="form-label">Incidente</label>
                        <input name="Nombre_incidente" type="text" class="form-control" id="firstName"
                            value="{{ $incidente->incNombre }}" disabled readonly>
                        <div class="invalid-feedback">
                            Se requiere un nombre válido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="proyecto" class="form-label">Proyecto</label>
                        <select name="Proyecto_incidente" class="form-select" id="proyecto" height="100px" width="100%"
                            disabled readonly>
                            @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->pk_id_proyecto }}"
                                    {{ $proyecto->pk_id_proyecto == $incidente->fk_id_proyecto ? 'selected' : '' }}>
                                    {{ $proyecto->proNombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Se requiere un proyecto válido.
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripción</label>
                        <textarea name="Descripcion_incidente" class="form-control" id="Descripcion" rows="5"
                            placeholder="Descripción sobre cómo sucedió el incidente" required maxlength="5000"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripcion válido.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Sugerencia" class="form-label">Sugerencia</label>
                        <textarea name="Sugerencia_incidente" class="form-control" id="Sugerencia" rows="5"
                            placeholder="Añada una sugerencia para que el incidente no vuelva a suceder" maxlength="5000"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="Gravedad" class="form-label">Nivel de Gravedad</label>
                        <button type="button" class="btn btn-sm btn-secondary" id="ayudaGravedad" data-bs-toggle="popover"
                            data-bs-placement="top" title="Ayuda sobre la Gravedad"
                            data-bs-content="Haga clic aquí para obtener más información">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                            </svg>
                        </button>
                        <select name="Gravedad_incidente" class="form-select" id="Gravedad" disabled readonly>
                            <option value="{{ $incidente->incGravedad }}">{{ $incidente->incGravedad }}</option>
                        </select>
                        <div class="invalid-feedback">
                            Se requiere seleccionar un nivel de gravedad válido.
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <label for="Evidencia" class="form-label">Evidencia</label>
                        <input name="Evidencia_incidente" class="form-control" type="file" id="Evidencia" multiple>
                        <div class="invalid-feedback">
                            Se requiere adjuntar una evidencia válida.
                        </div>
                    </div>
                    <!-- Sub lista de involucrados -->
                    <div class="mb-12">
                        <h5>Agregar Involucrados:</h5>
                        <table class="table bg-info" id="tabla">
                            <tr class="fila-fija">
                                <td><input name="Nombre_involucrado[]" placeholder="Nombre" /></td>
                                <td><input name="Apellido_involucrado[]" placeholder="Apellido" /></td>
                                <td><input name="Identificación_involucrado[]" placeholder="Numero de Identificacion"
                                        id="idInvolucrado" /></td>
                                <!-- Agrega el div para mostrar el mensaje de error -->
                                <div class="invalid-feedback" id="idInvolucradoError">
                                    El campo de identificación debe contener solo números.
                                </div>
                                <td><input name="Justificacion_involucrado[]" placeholder="Justificacion" /></td>
                                <td class="eliminar"><button type="button" class="btn btn-danger"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg></button></td>
                            </tr>
                        </table>
                        <div class="btn-der">
                            <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más +
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5>Involucrados registrados anteriormente</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Identificación</th>
                                    <th>Justificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incidente->involucrados as $involucrado)
                                    <tr>
                                        <td>{{ $involucrado->invNombre }}</td>
                                        <td>{{ $involucrado->invApellido }}</td>
                                        <td>{{ $involucrado->invNumDocumento }}</td>
                                        <td>{{ $involucrado->invJustificacion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                    <input type="hidden" name="Id_incidente" value="" class="d-none">
                    <!-- Fin de la sub lista de involucrados -->
                    <button class="btn btn-lg float-end custom-btn" id="guardarIncidenteButton"
                        style="font-size: 15px;">Guardar incidente</button>
            </form>
        </div>
    </div>
    </div>
    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas enviar el formulario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmarModalButton">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    La fase se ha creado exitosamente.
                </div>
            </div>

        </div>
        <script src="ReportarIncidente.js"></script>
    @endsection
    @section('js')
    <!-- Agrega tus scripts personalizados aquí -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
@stop