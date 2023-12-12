@extends('adminlte::page')

@section('title', 'Gestión de usuarios')

@section('content_header')
    <h1>Gestión de usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $heads = [['label' => 'Cédula', 'no-export' => false, 'width' => 10], 
                ['label' => 'Nombre', 'no-export' => false, 'width' => 10], 
                ['label' => 'Apellido', 'no-export' => false, 'width' => 10], 
                ['label' => 'Correo', 'no-export' => false, 'width' => 15], 
                ['label' => 'Nombre de usuario', 'no-export' => false, 'width' => 15], 
                ['label' => 'Teléfono', 'no-export' => false, 'width' => 15], 
                ['label' => 'Acciones', 'no-export' => false, 'width' => 20]];

                $btnEdit = '';
                $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                      <i class="fa fa-lg fa-fw fa-trash"></i>
                                  </button>';
             

                $config = [
                    'language' => [
                        'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    ],
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->pk_id_usuario }}</td>
                        <td>{{ $usuario->usuNombre }}</td>
                        <td>{{ $usuario->usuApellido }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->usuTelefono }}</td>
                        
                        <td><a href="{{route('usuario.edit',$usuario)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                            <form style="display: inline" action="{{ route('usuario.destroy', $usuario) }}" method="post"
                                class="formEliminar">
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                        
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Se va a eliminar un usuario",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminarlo"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit()
                        Swal.fire({
                            title: "Eliminado",
                            text: "El usuario ha sido eliminado",
                            icon: "success"
                        });
                    }
                });
            })
        })
    </script>
@stop
