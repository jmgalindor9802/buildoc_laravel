@extends('adminlte::page')

@section('title', 'Gestión de permisos')

@section('content_header')
    <h1>Gestión de permisos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <x-adminlte-button data-toggle="modal" data-target="#modalPurple" class="float-right" label="Crear permiso" theme="primary" icon="fas fa-key" />
        </div>
        <div class="card-body">
            @php
                $heads = [['label' => 'Id', 'no-export' => false, 'width' => 10], ['label' => 'Nombre', 'no-export' => false, 'width' => 10], ['label' => 'Acciones', 'no-export' => false, 'width' => 20]];

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
                @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->id }}</td>
                        <td>{{ $permiso->name }}</td>


                        <td><a href="{{ route('permisos.edit',$permiso) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
                                title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                                <form style="display: inline" action="{{ route('permisos.destroy', $permiso) }}" method="post"
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
    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nuevo permiso" theme="primary" icon="fas fa-bolt" size='lg'
        disable-animations>
        <form action="{{route('permisos.store')}}" method="post">
        @csrf
            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Nombre del permiso"
                    fgroup-class="col-md-6" disable-feedback/>
            </div>
            <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-key"/>
        </form>
    </x-adminlte-modal>
    
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
