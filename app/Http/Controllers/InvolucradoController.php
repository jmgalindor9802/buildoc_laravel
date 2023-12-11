<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiiInvolucrado;


class InvolucradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lastIncidenteId)
    {
        // Crear involucrados solo si los campos relacionados están presentes
        if (
            $request->filled('Nombre_involucrado') &&
            $request->filled('Apellido_involucrado') &&
            $request->filled('Identificación_involucrado') &&
            $request->filled('Justificacion_involucrado')
        ) {
            // Obtener datos de involucrados desde el formulario
            $involucrados = $request->input('Nombre_involucrado');
            $apellidos = $request->input('Apellido_involucrado');
            $documentos = $request->input('Identificación_involucrado');
            $justificaciones = $request->input('Justificacion_involucrado');

            // Crear involucrados
            foreach ($involucrados as $key => $nombre) {
                GiiInvolucrado::create([
                    'invNombre' => $nombre,
                    'invApellido' => $apellidos[$key],
                    'invNumDocumento' => $documentos[$key],
                    'invJustificacion' => $justificaciones[$key],
                    'fk_id_incidente' => $lastIncidenteId,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idIncidente)
    {
        // Crear involucrados solo si los campos relacionados están presentes
        if (
            $request->filled('Nombre_involucrado') &&
            $request->filled('Apellido_involucrado') &&
            $request->filled('Identificación_involucrado') &&
            $request->filled('Justificacion_involucrado')
        ) {
            // Obtener datos de involucrados desde el formulario
            $involucrados = $request->input('Nombre_involucrado');
            $apellidos = $request->input('Apellido_involucrado');
            $documentos = $request->input('Identificación_involucrado');
            $justificaciones = $request->input('Justificacion_involucrado');

            // Crear involucrados
            foreach ($involucrados as $key => $nombre) {
                GiiInvolucrado::create([
                    'invNombre' => $nombre,
                    'invApellido' => $apellidos[$key],
                    'invNumDocumento' => $documentos[$key],
                    'invJustificacion' => $justificaciones[$key],
                    'fk_id_incidente' => $idIncidente,
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
