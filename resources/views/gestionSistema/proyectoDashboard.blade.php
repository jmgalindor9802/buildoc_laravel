@extends('adminlte::page')
@section('content')

<div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb">
        <ol class=" breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Proyectos</a></li>
        </ol>
      </nav>
      <div>
        <h4 class="mb-3">Dashboard de proyectos</h4>
        <a href="{{route('proyecto.crear')}}"><button class="btn btn-lg float-end custom-btn" type="submit"
            style="font-size: 15px; margin-right: 5px;">+ Crear
            proyecto</button></a>
        <h1 class="display-6 mb-3" style="margin-bottom: 5px;">Ultimos proyectos creados</h1>
      </div>

      <div class="table-responsive vh-80">
        <table id="tablaProyectos" class="table table-striped table-hover sticky-header">
          <caption>Esta tabla muestra los proyectos existentes.</caption>
          <thead>
            <tr>
              <th scope="col">Proyecto</th>
              <th scope="col">Municipio</th>
              <th scope="col">Cliente</th>
              <th scope="col">Fecha de Creacion</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            /*
            require("../conexion.php");
            
            $sql = $conectar->query("SELECT * from ga_proyecto
            INNER JOIN ga_cliente ON ga_proyecto.fk_id_cliente = ga_cliente.pk_id_cliente 
            ORDER BY proFecha_creacion DESC");



            while ($resultado = $sql->fetch_assoc()){
            */
            ?>

            <tr>
              <td scope="row"><?/* echo $resultado ['proNombre']*/?></td>
              <td scope="row"><?/*php echo $resultado ['proMunicipio']*/?></td>
              <td scope="row"><?/*php echo $resultado ['cliNombre']*/?></td>
              <td scope="row"><?/*php // Utiliza la función date de PHP para formatear la fecha
                                    $fechaHora = $resultado['proFecha_creacion'];
                                    $fechaFormateada = date("j M Y", strtotime($fechaHora)); 
                                    echo $fechaFormateada;*/?></td>
              <td scope="row">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                    <path
                      d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                  </svg>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="actualizar_proyecto_form.php?pk_id_proyecto=<?/*php echo $resultado['pk_id_proyecto']*/?>" class="dropdown-item">Actualizar</a></li>
                  <li><a href="detalles_proyecto_form.php?pk_id_proyecto=<?/*php echo $resultado['pk_id_proyecto']*/?>" class="dropdown-item">Detalles</a></li>
                  <li><a class="dropdown-item text-danger" href="eliminar_proyecto.php?Id=<?php/* echo $resultado['pk_id_proyecto']; */?>">Archivar <svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                          d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                        <path
                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                      </svg></a>
                  </li>
                </ul>
              </td>
            </tr>
            <?php
            /*
            }
            */
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <div class="modal" tabindex="-1" id="EliminarProyecto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar proyecto</h5>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro de eliminar este proyecto?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="Proyecto_dashboard.js"></script>
  <script type="text/javascript">
    let table = new DataTable('#tablaProyectos', {
    //Para cambiar el lenguaje a español
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando del 0 al 0 de 0 registros",
        "infoFiltered": "(de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando..."
    }
   })
  </script>
@endsection
