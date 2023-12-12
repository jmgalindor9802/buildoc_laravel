@extends('adminlte::page')
@section('tituloform', 'Programar inspeccion')
@section('content')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet" crossorigin="anonymous">
@if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Error al enviar el formulario</strong>
                                <br>
                                <ul>
                                    @foreach ($errors->all() as $eroor)
                                        <li>{{ $eroor }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    <div class="col-12 border-left ">
        <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Inspección</a></li>
                <li class="breadcrumb-item active" aria-current="page">Programar inspección</li>
            </ol>
        </nav>
       
        <div class="col-12 custom-form vh-80">
            <br>

            <form action="{{ route('inspeccion.store') }}" method="POST" class="needs-validation " style="max-height: 70vh"
                novalidate>
                @csrf
                <div class="d-flex justify-content-between align-items-center">
    <h4 class="mb-3 custom-form">Programar inspección</h4>
    <div class="d-flex">
    <a href="{{ route('inspecciones.dashboard') }}" class="btn btn-primary" style="margin-right: 10px;">Regresar</a>
            <button class="btn btn-warning" id="guardarTareaButton" style="font-size: 15px;">Guardar inspección</button>
    </div>
</div>
<br>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="proyecto" class="form-label">Proyecto</label>
                        <select name="proyecto_inspeccion" class="form-select" id="proyecto" required>
                            <option value="">Seleccionar...</option>
                            @if (isset($proyectos))
                                @foreach ($proyectos as $proyecto)
                                    <option value="{{ $proyecto->pk_id_proyecto }}">{{ $proyecto->proNombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="invalid-feedback">
                            Se requiere seleccionar un proyecto válido.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label id="nombreInspeccion" for="firstName" class="form-label">Nombre de la inspección</label>
                        <input name="nombre_Inspeccion" type="text" class="form-control" id="firstName"
                            placeholder="Nombre de la inspección" value="" required required maxlength="280">
                        <div class="invalid-feedback">
                            Se requiere un nombre válido.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="Evidencia" class="form-label">Adjuntar formulario de inspección</label>
                        <input name="fourmulario_inspeccion" class="form-control" type="file" id="Evidencia" multiple
                            required>
                        <div class="invalid-feedback">
                            Se requiere adjuntar una evidencia válida.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="periodicidad" class="form-label">Periodicidad</label>
                        <!-- boton de ayuda -->
                        <button type="button" class="btn btn-sm btn-secondary" id="ayudaGravedad" data-bs-toggle="popover"
                            data-bs-placement="top" title="Ayuda sobre la Gravedad"
                            data-bs-content="Haga clic aquí para obtener más información">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                            </svg>
                        </button>
                        <!-- lista de opciones para la seleccion -->
                        <select name="insPeriodicidad" class="form-select" id="periodicidad" required>
                            <option value="">Seleccionar...</option>
                            <option value="DIARIA">Diaria</option>
                            <option value="SEMANAL">Semanal</option>
                            <option value="MENSUAL">Mensual</option>
                            <option value="NINGUNA">Ninguna</option>
                        </select>
                        <div class="invalid-feedback">
                            Se requiere seleccionar una periodicidad válida.
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none;" id="contenedor_FechaInspeccion">
                        <label for="FechaInspeccion"> Fecha y hora de la inspección</label>
                        <input name="fecha_unica_inspeccion" type="datetime-local" class="form-control" id="FechaInspeccion"
                            required>
                        <div class="invalid-feedback" id="error-fechaInspeccion-mensaje">
                            Seleccione una fecha y hora válida.
                        </div>
                        <div class="invalid-feedback" id="error-fechaInspeccion-anterior-mensaje">
                            La fecha y hora de inspección debe ser posterior a la actual.
                        </div>
                    </div>
                    <div class="col-md-4" style="display: none;" id="contenedor_fechaInicial">
                        <label for="fechaInicial">Fecha y hora de inicio:</label>
                        <input name="fechaInicialInspeccion" type="datetime-local" class="form-control" id="fechaInicial"
                            required>
                        <div class="invalid-feedback" id="error-fechaInicial-mensaje">
                            Seleccione una fecha y hora válida.
                        </div>
                        <div class="invalid-feedback" id="error-fechaInicial-anterior-mensaje">
                            La fecha y hora de inicio debe ser posterior a la actual.
                        </div>
                    </div>
                    <div class="col-md-4" style="display: none;" id="contenedor_fechaFinal">
                        <label for="fechaFinal">Fecha y hora de finalización:</label>
                        <input name="fechaFinalInspeccion" type="datetime-local" class="form-control" id="fechaFinal"
                            required>
                        <div class="invalid-feedback" id="error-fechaFinal-mensaje">
                            La fecha y hora de finalización es inválida.
                        </div>
                        <div class="invalid-feedback" id="error-fechaFinal-anterior-mensaje">
                            La fecha y hora de finalización debe ser posterior a la actual.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea name="descripcionInspeccion" class="form-control" id="exampleFormControlTextarea1" rows="5"
                            placeholder="Descripción del proyecto" required maxlength="5000"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                    </div>
                  
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h4>Asignar usuarios</h4>
                            <label for="usuario_proyecto_disponible" class="form-label">Seleccione a quienes desea asignar
                                al proyecto</label>
                            <ul class="list-group" id="usuario_proyecto_disponible">
                                @foreach ($usuarios as $usuario)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usuarios_proyecto[]"
                                            value="{{ $usuario->pk_id_usuario }}"
                                            id="checkbox{{ $usuario->pk_id_usuario }}">
                                        <label class="form-check-label"
                                            for="checkbox{{ $usuario->pk_id_usuario }}">{{ $usuario->nombreCompleto() }}</label>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                
                </div>
        </div>
        @include('components.modalConfirmacion')
    </div>

    </form>
    </div>
    <script src="{{ asset('js/programarInspeccion.js') }}"></script>
   <!-- ... Bibliotecas jQuery y Bootstrap ... -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
crossorigin="anonymous"></script>
<!-- ... Tu script personalizado ... -->
<script src="{{ asset('js/fase.js') }}"></script>


<script>

// Lógica para abrir el modal de confirmación
$('#guardarTareaButton').on('click', function (event) {
  // Evitar la redirección predeterminada
  event.preventDefault();
  // Lógica para abrir el modal
  $('#confirmModal').modal('show');
});

// Lógica para enviar el formulario cuando se confirma en el modal
$('#confirmarModalButton').on('click', function () {
  // Descomentar la siguiente línea si deseas enviar el formulario desde el modal
  $('form').submit();
  // Cerrar el modal de confirmación
  $('#confirmModal').modal('hide');
});
</script>


@endsection
@section('js')
    <!-- Agrega tus scripts personalizados aquí -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
@stop