@extends('adminlte::page')

@section('title', 'Gestión de tareas')

@section('content_header')
    <h1>Gestión de tareas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $heads = [
                    ['label' => 'Proyecto'],
                    ['label' => 'Fase'],
                    ['label' => 'Tarea'],
                    ['label' => 'Descripción'],
                    ['label' => 'Fecha límite'],
                    ['label' => 'Acciones', 'no-export' => false, 'width' => 20],
                ];

                $config = [
                    'language' => [
                        'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    ]
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach ($tareas as $tarea)
                    <tr>
                        <td>{{$tarea->fase->proyecto->proNombre}}</td>
                        <td>{{$tarea->fase->fasNombre}}</td>
                        <td>{{$tarea->tarNombre}}</td>
                        <td>{{$tarea->tarDescripcion}}</td>
                        <td>{{$tarea->tarFecha_limite}}</td>
         
                        <td>
                            <a href="{{ route('tarea.edit', $tarea->pk_id_tarea) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <a href="{{ route('tarea.show', $tarea->pk_id_tarea) }}" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>
                            {{-- Puedes agregar más botones de acciones aquí --}}
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
        console.log('Hi!');
    </script>
@stop
