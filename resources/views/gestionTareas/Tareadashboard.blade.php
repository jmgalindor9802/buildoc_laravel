@extends('layouts.app')

@section('content')

    <div class="col">
        <nav aria-label="breadcrumb" class=" align-items-center  ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Tareas</a></li>
            </ol>
        </nav>
        <div style="padding-right:5%">
            <h4 class="mb-3">Tareas </h4>
            <form id="formProyecto" method="post" action="Tareas_dashboard.php">
                <a href="{{route('crear.tarea')}}"><button class="btn btn-lg float-end custom-btn" type="button"
                        style="font-size: 15px; margin-right:1%">+ Crear
                        tarea</button></a>
                <a href="{{route('crear.fase')}}"><button class="btn btn-lg float-end custom-btn" type="button"
                        style="font-size: 15px ;margin-right:1% ">+ Crear fase</button></a>
                <h1 class="display-6">Tareas próximas</h1>
                <div class="dropdown">

                </div>
            </form>
        </div>
        <div class="table-responsive vh-80 dataTables_wrapper dt-bootstrap5">
        <table id="tablaTareas" class="table table-striped sticky-header">
    <caption>Esta tabla muestra las tareas pendientes por proyecto seleccionado</caption>
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
    @foreach ($tareas as $tarea)
    <tr>
    <td scope="row">{{ $tarea->fase->proyecto->proNombre ?? '' }}</td>
        <td scope="row">{{ $tarea->fase->fasNombre ?? '' }}</td>
        <td scope="row">{{ $tarea->tarNombre }}</td>
        <td scope="row">{{ \Carbon\Carbon::parse($tarea->tarFecha_limite)->format('j M Y') }}</td>
        <td scope="row">{{ $tarea->responsable->nombre_completo ?? '' }}</td>
        <td></td>
        <td scope="row">
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Acciones
                </button>
                <ul class="dropdown-menu">
                    <li><a id="btn-desplegable-detalles" href="{{ route('tarea.edit', $tarea->pk_id_tarea) }}" class="dropdown-item">Actualizar</a></li>
                    <li><a id="btn-desplegable-detalles" href="{{ route('tarea.show', $tarea->pk_id_tarea) }}" class="dropdown-item  text-danger">Eliminar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6a.5.5 0 0 0-.5-.5ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                            </svg></a></li>
                </ul>
            </div>
        </td>
    </tr>
@endforeach
    </tbody>
</table>


        </div>
    </div>
@endsection
