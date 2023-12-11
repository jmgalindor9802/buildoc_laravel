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
                    <input type="text" class="form-control" value="{{ optional($tarea->proyecto)->proNombre ?? '' }}" readonly>
                </div>

                <div class="col-sm-5">
                    <label for="fase" class="form-label">Fase</label>
                    <input type="text" class="form-control" value="{{ optional($tarea->fase)->nombre_fase ?? '' }}" readonly>
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

            <!-- Elimina el bloque de selección de usuarios y tareas dependientes si no es necesario para la edición -->
            
            <br>
            <button type="submit" class="btn btn-lg float-end custom-btn" style="font-size: 15px;">Guardar tarea</button>
        </form>
    </div>
</div>

<!-- ... Bibliotecas jQuery y Bootstrap ... -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- ... Tu script personalizado ... -->
<script src="{{ asset('js/fase.js') }}"></script>

@endsection
