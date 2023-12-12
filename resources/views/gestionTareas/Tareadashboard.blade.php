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
            ['label' => 'Fecha limite'],
            ['label' => 'Acciones', 'no-export' => false, 'width' => 20],
            ];

            $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>';
            $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
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
                @foreach ($tareas as $tarea)
                    <tr>
                        <td>{{$tarea->fase->proyecto->proNombre}}</td>
                        <td>{{$tarea->fase->fasNombre}}</td>
                        <td>{{$tarea->tarNombre}}</td>
                        <td>{{$tarea->tarDescripcion}}</td>
                        <td>{{$tarea->tarFecha_limite}}</td>
         
                        <td>{!! $btnEdit !!}
                      
                                {!!$btnDelete!!}

                            {!!$btnDetails!!}</td>
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