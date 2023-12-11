@extends('layouts.app')
@section('tituloform', 'Crear tarea')
@section('content')

<div class="col-10 border-left ">
        <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear tarea</li>
            </ol>
        </nav>
        <h4 class="mb-3 custom-form">Crear tarea</h4>
        <div class="col-12 custom-form vh-80">
            <br>

                <form action="{{ route('tarea.store') }}" class="needs-validation " style="max-height: 70vh;  overflow-y;"  method="post"  >
                @csrf    
                <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                    <div class="row g-3 ">
                            <div class="col-sm-6" >
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select name="tarProyecto" class="form-select" id="proyecto" required>
                            <option value="" disabled selected>Seleccionar...</option>

                                @if(isset($proyectos))
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->pk_id_proyecto }}">{{ $proyecto->proNombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        
                                        <div class="invalid-feedback">
                                        Seleccione un proyecto.
                                        </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <label for="fase" class="form-label">Fase</label>
                                                    <select name="tarFase" class="form-select" id="fase" required>
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <option value="1">Fase 1</option>
                                                        <option value="2">Fase 2</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Seleccione una fase.
                                                    </div>
                                                </div>
                                        </div>
                                    
                    <br>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label for="Nombre_Tarea" class="form-label">Nombre de la
                                tarea</label>
                            <input name="tarNombre" type="text" class="form-control" id="Nombre_Tarea" placeholder="Nombre de la tarea"
                                required>
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        
                        <div class="col-sm">
                            <label  for="fechaLimite" class="form-label">Fecha y hora
                                límite</label>
                            <input name="tarFechaLimite" type="datetime-local" class="form-control" id="fechaLimite" required>
                            <div class="invalid-feedback">
                                Seleccione una fecha y hora válida.
                            </div>
                            <div class="invalid-feedback" id="error-fecha-mensaje">
                                La fecha y hora límite debe ser posterior a la actual.
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select name="tarPrioridad" class="form-select" id="prioridad" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="ALTA">Alta</option>
                                <option value="BAJA">Baja</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleccione una prioridad.
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row g-3">
                    <div class="col-sm-12">
                        <label for="descripcionTarea" class="form-label">Descripción</label>
                        <textarea name="tarDescripcion" class="form-control" id="descripcionTarea" rows="4"
                            placeholder="Descripción de la tarea" required maxlength="450"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                    </div>
                    </div>
                    <br>
              
                    <br>
                   
                            <div class="row g-3" >
                                <div class="col-md-5">
                                    <h4>Asignar usuarios</h4>
                                    <ul class="list-group" >
                                    <?php
                                    //Lista de Usuarios
                                    /*include("../conexion.php");
                                    $sql = $conectar->query("SELECT pk_id_usuario, CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo 
                                    FROM usuario ORDER BY nombre_completo ASC");
                                    while ($resultado = $sql->fetch_assoc()) {
                                        echo '<div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usuarios_tareas[]" value="' . $resultado['pk_id_usuario'] . '" id="checkbox' . $resultado['pk_id_usuario'] . '">
                                        <label class="form-check-label" for="usuarios_tareas' . $resultado['pk_id_usuario'] . '">' . $resultado['nombre_completo'] . '</label>
                                      </div>';
                                    }*/
                                    ?>
                                    </ul>
                                </div>
                                <div class="col-md-5" >
                                    <h4>Asignar tareas dependientes</h4>    
                                    <ul class="list-group" id="tasksContainer">
                                    </ul>
                                </div>
                            </div>   
                            <br> 
                            <div class="col-md-5">               
                            <!-- Botón "Guardar tarea" que abre el modal -->
                        <button class="btn btn-lg float-end custom-btn" id="guardarTareaButton"
                        style="font-size: 15px;">Guardar tarea</button>

                        @include('components.modalConfirmacion')
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