@extends('adminlte::page')

@section('title', 'Gestión de usuarios')

@section('content_header')
    <h1>Gestión de usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @php
            $heads = [
            'Cédula',
            'Nombre',
            'Apellido',
            'Correo',
            'Nombre de usuario',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 20],
            ];

            $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                      <i class="fa fa-lg fa-fw fa-trash"></i>
                                  </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                       <i class="fa fa-lg fa-fw fa-eye"></i>
                                   </button>';

            $config = [
                'language'=>[
                    'url'=>'//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                ]
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->pk_id_usuario}}</td>
                        <td>{{$usuario->usuNombre}}</td>
                        <td>{{$usuario->usuApellido}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{!!$btnEdit!!}{!!$btnDelete!!}{!!$btnDetails!!}</td>
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
        console.log('Hi!');
    </script>
@stop
