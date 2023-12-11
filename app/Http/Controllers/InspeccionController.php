<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\GiiInspeccion;
use Carbon\Carbon;
use App\Models\Usuario;

class InspeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspecciones = GiiInspeccion::select(
            'gii_inspeccion.pk_id_inspeccion',
            'gii_inspeccion.insNombre',
            'gii_inspeccion.insEstado',
            'gii_inspeccion.insFecha_inicial',
            'gii_inspeccion.insFecha_final',
            'ga_proyecto.proNombre'
        )
            ->join('ga_proyecto', 'gii_inspeccion.fk_id_proyecto', '=', 'ga_proyecto.pk_id_proyecto')
            ->with('proyecto')
            ->get();
        // Formatear la fecha usando Carbon
        foreach ($inspecciones as $inspeccion) {
            $inspeccion->insFecha_inicial = Carbon::parse($inspeccion->insFecha_inicial)->format('j M Y');
            $inspeccion->insFecha_final = Carbon::parse($inspeccion->insFecha_final)->format('j M Y');
        }
        return view('gestionInspeccion&Incidente.inspeccionDashboard', compact('inspecciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = Usuario::orderByRaw("CONCAT(usuNombre, ' ', usuApellido)")->get();
        $proyectos = Proyecto::orderBy('proNombre')->get();
        return view('gestionInspeccion&Incidente.programarInspeccion', compact('usuarios', 'proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
