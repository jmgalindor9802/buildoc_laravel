@extends('layouts.app')

@section('content')

<div class="col-10 border-left">
    <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Tareas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar tarea</li>
        </ol>
    </nav>
    
    <div class="d-flex justify-content-between align-items-center">
    <h4 class="mb-3 custom-form">Eliminar tarea</h4>
    <div class="d-flex">
    <a href="{{ route('tarea.dashboard') }}" class="btn btn-primary" style="margin-right: 10px;">Regresar</a>
        <form action="{{ route('tarea.destroy', $tarea->pk_id_tarea) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" id="guardarTareaButton" style="font-size: 15px;">Eliminar tarea</button>
        </form>
    </div>
</div>



    <div class="col-12 custom-form vh-80">
        <br>

        <div class="alert alert-danger" role="alert">
            Va a eliminar esta tarea
            <br>
            <br>
          
            <table id="tablaTareas" class="table table-striped sticky-header">
            <caption>Esta tabla muestra las tareas que va a eliminar</caption>
            <thead>
            <tr>
            <th class="col-2" scope="col">Proyecto</th>
            <th class="col-2" scope="col">Fase</th>
            <th class="col-3" scope="col">Tarea</th>
            <th class="col-2" scope="col">Fecha y Hora Límite</th>
            <th class="col-2" scope="col">Responsable</th>
            <th class="col-1" scope="col">Tiempo Restante</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">{{ $tarea->fase->proyecto->proNombre ?? '' }}</td>
            <td scope="row">{{ $tarea->fase->fasNombre ?? '' }}</td>
            <td scope="row">{{ $tarea->tarNombre }}</td>
            <td scope="row">{{ \Carbon\Carbon::parse($tarea->tarFecha_limite)->format('j M Y') }}</td>
            <td scope="row">{{ $tarea->responsable->nombre_completo ?? '' }}</td>
            <td></td>
            <td scope="row">
                
            </td>
        </tr>
    </tbody>
</table>


        </div>
    </div>

  
    

                        @include('components.modalConfirmacion')
    
    <!-- ... Bibliotecas jQuery y Bootstrap ... -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
crossorigin="anonymous"></script>
<!-- ... Tu script personalizado ... -->
<script src="{{ asset('js/fase.js') }}"></script>



@endsection
