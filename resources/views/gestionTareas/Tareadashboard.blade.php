@extends('layouts.app')
@section('tituloform', 'Programar inspeccion')
@section('content')

    <div class="col-lg-10">
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a id="btn-desplegable-detalles" href="actualizar_usuario_form.php"
                                        class="dropdown-item">Actualizar</a></li>
                                <li><a id="btn-desplegable-seguimiento" href="detalles_usuario_form.php"
                                        class="dropdown-item">Detalles</a></li>
                                <li><a class="dropdown-item text-danger" href="eliminar_usuario.php" data-bs-toggle="modal"
                                        data-bs-target="#EliminarUsuario">Archivar <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-trash"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg></a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
@endsection
