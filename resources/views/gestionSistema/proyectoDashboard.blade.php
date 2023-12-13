@extends('adminlte::page')

@section('title', 'Gestión de usuarios')

@section('content_header')
    <h1>Gestion de proyectos</h1>
@stop

@section('content')
    <a href="{{route('proyecto.crear')}}"><button class="btn btn-lg float-end custom-btn" type="button"
            style="font-size: 15px; margin-right: 5px;">+ Crear
            proyecto</button></a>
    <div class="card">
        <div class="card-body">
            @php
                $heads = [['label' => 'Proyecto'], ['label' => 'Municipio'], ['label' => 'Cliente'], ['label' => 'Fecha de creacion'], ['label' => 'Acciones', 'no-export' => false, 'width' => 20]];

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
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->proNombre }}</td>
                        <td>{{ $proyecto->proMunicipio }}</td>
                        <td>{{ $proyecto->cliente->cliNombre }}</td>
                        <td>{{ $proyecto->proFecha_creacion }}</td>
                        <td>
                            <form action="{{ route('proyecto.destroy', $proyecto) }}" method="post" class="formEliminar">
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
