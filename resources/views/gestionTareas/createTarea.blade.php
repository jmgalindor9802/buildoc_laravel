@extends('adminlte::page')
@section('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <div class="col-12 border-left ">
        <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear tarea</li>
            </ol>
        </nav>
        <div class="col-12 custom-form vh-80">

            <form action="{{ route('tarea.store') }}" class="needs-validation " style="max-height: 70vh;  overflow-y;"
                method="post">
                @csrf
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-3 custom-form">Crear tarea</h4>
                    <div class="d-flex">
                        <a href="{{ route('tarea.dashboard') }}" class="btn btn-primary"
                            style="margin-right: 10px;">Regresar</a>
                        <button class="btn btn-warning" id="guardarTareaButton" style="font-size: 15px;">Guardar
                            tarea</button>
                    </div>
                </div>
                <br>
                <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                <div class="row g-3 ">
                    <div class="col-sm-6">
                        <label for="proyecto" class="form-label">Proyecto</label>
                        <select name="tarProyecto" class="form-select" id="proyecto" required>
                            <option value="" disabled selected>Seleccionar...</option>

                            @if (isset($proyectos))
                                @foreach ($proyectos as $proyecto)
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
                        <input name="tarNombre" maxlength="45" type="text" class="form-control" id="Nombre_Tarea"
                            placeholder="Nombre de la tarea" required>
                        <div class="invalid-feedback">
                            Se requiere un nombre válido.
                        </div>
                    </div>

                    <div class="col-sm">
                        <label for="fechaLimite" class="form-label">Fecha y hora
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

                <div class="row g-3">
                    <div class="col-md-5">
                        <h4>Asignar usuarios</h4>
                        <ul class="list-group">
                            @foreach ($usuarios as $usuario)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="usuarios_proyecto[]"
                                        value="{{ $usuario->pk_id_usuario }}" id="checkbox{{ $usuario->pk_id_usuario }}">
                                    <label class="form-check-label"
                                        for="checkbox{{ $usuario->pk_id_usuario }}">{{ $usuario->nombreCompleto() }}</label>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <h4>Asignar tareas dependientes</h4>
                        <ul class="list-group" id="tasksContainer">
                        </ul>
                    </div>
                </div>
                <br>
                <div class="col-md-5">

                    @include('components.modalConfirmacion')


                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- ... Bibliotecas jQuery y Bootstrap ... -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <!-- ... Tu script personalizado ... -->
    <script src="{{ asset('js/fase.js') }}"></script>


    <script>
        // Lógica para abrir el modal de confirmación
        $('#guardarTareaButton').on('click', function(event) {
            // Evitar la redirección predeterminada
            event.preventDefault();
            // Lógica para abrir el modal
            $('#confirmModal').modal('show');
        });

        // Lógica para enviar el formulario cuando se confirma en el modal
        $('#confirmarModalButton').on('click', function() {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
@stop
