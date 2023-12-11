@extends('layouts.app')
@section('tituloform', 'Editar Tarea')
@section('content')

<div class="col-10 border-left">
    <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Tareas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar tarea</li>
        </ol>
    </nav>
    <h4 class="mb-3 custom-form">Editar tarea</h4>
    <div class="col-12 custom-form vh-80">
        <br>

        <form action="{{ route('tarea.update', $tarea->pk_id_tarea) }}" method="post" class="needs-validation" style="max-height: 70vh; overflow-y;">
            @csrf
            @method('PUT')

            <!-- Muestra el nombre del proyecto y la fase en lugar de campos de selección -->
            <div class="row g-3 ">
            <div class="row g-3 ">
                <div class="col-sm-5">
                    <label for="proyecto" class="form-label">Proyecto</label>
                    <input type="text" class="form-control" value="{{ $tarea->fase->proyecto->proNombre ?? '' }}" readonly>
                </div>

                <div class="col-sm-5">
                    <label for="fase" class="form-label">Fase</label>
                    <input type="text" class="form-control" value="{{ $tarea->fase->fasNombre ?? '' }}" readonly>
                </div>
            </div>





            <br>
            <div class="row g-3">
                <div class="col-sm-5">
                    <label for="Nombre_Tarea" class="form-label">Nombre de la tarea</label>
                    <input name="tarNombre" type="text" class="form-control" id="Nombre_Tarea" placeholder="Nombre de la tarea" value="{{ $tarea->tarNombre }}" required>
                    <div class="invalid-feedback">
                        Se requiere un nombre válido.
                    </div>
                </div>

                <div class="col-sm-5">
                    <label for="fechaLimite" class="form-label">Fecha y hora límite</label>
                    <input name="tarFechaLimite" type="datetime-local" class="form-control" id="fechaLimite" value="{{ \Carbon\Carbon::parse($tarea->tarFecha_limite)->format('Y-m-d\TH:i') }}" required>
                    <div class="invalid-feedback">
                        Seleccione una fecha y hora válida.
                    </div>
                    <div class="invalid-feedback" id="error-fecha-mensaje">
                        La fecha y hora límite debe ser posterior a la actual.
                    </div>
                </div>
            </div>
            <br>

            <div class="row g-3">
                <div class="col-sm-10">
                    <label for="descripcionTarea" class="form-label">Descripción</label>
                    <textarea name="tarDescripcion" class="form-control" id="descripcionTarea" rows="4" placeholder="Descripción de la tarea" required maxlength="450">{{ $tarea->tarDescripcion }}</textarea>
                    <div class="invalid-feedback">
                        Se requiere una descripción válida.
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="prioridad" class="form-label">Prioridad</label>
                    <select name="tarPrioridad" class="form-select" id="prioridad" required>
                        <option value="" disabled selected>Seleccionar...</option>
                        <option value="ALTA" @if($tarea->tarPrioridad == 'ALTA') selected @endif>Alta</option>
                        <option value="BAJA" @if($tarea->tarPrioridad == 'BAJA') selected @endif>Baja</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione una prioridad.
                    </div>
                </div>
            </div>
            <br>

            <div class="col-md-5">               
                            <!-- Botón "Guardar tarea" que abre el modal -->
                        <button class="btn btn-lg float-end custom-btn" id="guardarTareaButton"
                        style="font-size: 15px;">Guardar tarea</button>

                        <!-- Modal de confirmación -->
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas enviar el formulario?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="confirmarModalButton">Confirmar</button>
                                </div>
                            </div>
                        </div>
                        </div>
                                        <!-- Modal de éxito -->
                                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                                        aria-labelledby="successModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    La tarea se ha creado exitosamente.
                                                </div>
                                            </div>

                                        </div>
                           
                        </div>
                        </div>
                        </form>
            </div>
        </div>
    </div>

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
