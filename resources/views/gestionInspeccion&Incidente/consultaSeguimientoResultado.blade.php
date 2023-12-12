@extends('layouts.app')
@section('tituloform', 'Seguimiento consultado')
@section('content')
    @if (session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Agrega esto en tu vista para mostrar los resultados -->
    @if (isset($seguimientos) && is_array($seguimientos))
        <h2>Resultados de la Consulta de Seguimientos</h2>
        <ul>
            @foreach ($seguimientos as $seguimiento)
                <li>
                    - Incidente: {{ $seguimiento->Incidente }}
                    - Descripción: {{ $seguimiento->{"Descripcion del seguimiento"} }}
                    - Fecha y hora de actualización: {{ $seguimiento->{"Fecha y hora de actualizacion"} }}
                    - Sugerencia en el seguimiento: {{ $seguimiento->{"Sugerencia en el seguimiento"} }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection