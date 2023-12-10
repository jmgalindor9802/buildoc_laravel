<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\GiiIncidente;
use Carbon\Carbon;

class IncidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidentes = GiiIncidente::select(
            'gii_incidente.pk_id_incidente',
            'gii_incidente.incNombre',
            'gii_incidente.incEstado',
            'gii_incidente.incGravedad',
            'gii_incidente.incFecha',
            'ga_proyecto.proNombre'
        )
            ->join('ga_proyecto', 'gii_incidente.fk_id_proyecto', '=', 'ga_proyecto.pk_id_proyecto')
            ->with('proyecto') // Cargar la relación proyecto
            ->get();
        // Formatear la fecha usando Carbon
        foreach ($incidentes as $incidente) {
            $incidente->incFecha = Carbon::parse($incidente->incFecha)->format('j M Y');
        }
        return view('gestionInspeccion&Incidente.incidenteDashboard', compact('incidentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyecto::orderBy('proNombre')->get();
        return view('gestionInspeccion&Incidente.ReportarIncidente', compact('proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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
    public function update(Request $request, $id)
    {
        //
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
