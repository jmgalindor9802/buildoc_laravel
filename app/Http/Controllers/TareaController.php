<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Fase;
use App\Models\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestionTareas.Tareadashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyecto::orderBy('proNombre')->get();
        $fases = Fase::orderBy('fasNombre')->get();

    // Pasar proyectos y fases a la vista
    return view('gestionTareas.createTarea', compact('proyectos', 'fases'));
    }

   
    public function getFasesByProyecto($proyectoId)
{
    $fases = Fase::where('fk_id_proyecto', $proyectoId)->orderBy('fasNombre')->get();
    return response()->json($fases);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea= new Tarea();

        $tarea-> tarNombre = $request -> tarNombre;
        $tarea-> tarDescripcion = $request -> tarDescripcion;
        $tarea-> tarPrioridad = $request -> tarPrioridad;
        $tarea-> tarFecha_limite = $request -> tarFechaLimite;
        $tarea-> fk_id_fase = $request -> tarFase;
        
        $tarea-> save();

       return view('gestionTareas.Tareadashboard');
       return redirect()->route('/tarea')->with('success', 'Tarea creada exitosamente');
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
