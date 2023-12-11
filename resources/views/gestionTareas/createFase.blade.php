@extends('layouts.app')
@section('tituloform', 'Crear fase')
@section('content')
<div class="col-10 border-left ">
        <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear fase</li>
            </ol>
        </nav>
        <h4 class="mb-3 custom-form">Crear fase</h4>
        <div class="col-12 custom-form vh-80">
            <br>

                <form action="{{ route('fase.store') }}"  method="post"   class="needs-validation " style="max-height: 70vh; " novalidate>
                @csrf
                    <!-- INSERTAR NOMBRE FASE -->
                    <div class="row g-3">   
                        <div class="col-sm-6">
                            <label  for="Nombre_fase" class="form-label">Nombre de la
                                fase</label>
                            <input name="nombre" type="text" class="form-control" id="Nombre_fase" placeholder="Nombre de la fase" required>
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                        <div class="col-md-6">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select name="proyecto" class="form-select" id="proyecto" required>
                                <option value="">Elegir...</option>

                                @if(isset($proyectos))
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->pk_id_proyecto }}">{{ $proyecto->proNombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>


                            <div class="invalid-feedback">
                                Seleccione una fase.
                            </div>
                        </div>
                        </div>
                        <br>
                        <!-- DESCRIPCION DE LA FASE -->
                        <div class="row g-3">
                        <label  for="Descripcion_fase" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="Descripcion_fase" rows="4" placeholder="Descripción de la fase" required maxlength="450"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                        </div>
                        <br>
                        <!-- Botón "Guardar fase" que abre el modal -->
                        <button class="btn btn-lg float-end custom-btn" id="guardarFaseButton"
                        style="font-size: 15px;">Guardar fase</button>

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
                                    La fase se ha creado exitosamente.
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- ... Tu script personalizado ... -->
<script src="../crear_fase.js"></script>
<script>
$(document).ready(function () {
  $('#guardarFaseButton').on('click', function (event) {
       // Evitar la redirección predeterminada
       event.preventDefault();
    // Lógica para abrir el modal
    $('#confirmModal').modal('show');
  });
});
</script>

<script>
    console.log(@json($proyectos));
</script>
<script>{{asset('js\fase.js')}}</script>


@endsection