@extends('layouts.app')

@section('content')

    <div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Clientes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Crear cliente</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Nuevo cliente</h4>
      <div class="col-12 custom-form vh-80">
      <form id="formRegistroCliente" class="needs-validation" method="post" action="crear_cliente.php" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label id="ClienteNIT" for="document" class="form-label">NIT</label>
              <input name="ClienteNIT" type="number" class="form-control" 
              value="" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un NIT válido.
            </div>
            <div class="col-sm-6">
            <label id="ClienteNombre" for="name" class="form-label">Nombre</label>
              <input name="ClienteNombre" type="text" class="form-control" 
              value="" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un nombre válido.
            </div>
            <div class="col-md-6">
              <label id="ClienteCorreo" for="email" class="form-label">Correo</label>
              <input name="ClienteCorreo" type="email" class="form-control"
                value="" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un correo válido.
            </div>
            <div class="col-sm-6">
            <label id="ClienteTelefono" for="phone" class="form-label">Telefono</label>
            <input name="ClienteTelefono" type="number" class="form-control"
                value="" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un telefono válido.
            </div>
            </div>
            <div class="py-4">
            <button class="btn btn-lg float-start custom-btn" style="font-size: 15px;"
              type="submit">Crear
                cliente</button>
              <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
              href="Cliente_dashboard.php">Cancelar</a>
            </div>
            </div>
            </form>
            </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="crear_cliente_form.js"></script>
@endsection