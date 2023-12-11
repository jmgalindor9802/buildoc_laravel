<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;
use App\Models\Proyecto;

class FaseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestionTareas.createFase');
    }
    public function getFasesByProyecto($proyectoId)
    {
    $fases = Fase::where('fk_id_proyecto', $proyectoId)->orderBy('fasNombre')->get();
    return response()->json($fases);
    }
    public function __construct()
    {
    $this->middleware('web');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Obtener todos los proyectos desde el modelo Proyecto
        $proyectos = Proyecto::orderBy('proNombre')->get();

    // Pasar los proyectos a la vista
    return view('gestionTareas.createFase', compact('proyectos'));

    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fase= new Fase();

        $fase-> fasNombre = $request -> nombre;
        $fase-> fk_id_proyecto = $request -> proyecto;
        $fase-> fasDescripcion = $request -> descripcion;
        $fase-> save();

       return redirect()->route('tarea.dashboard')->with('success', 'Fase creada exitosamente');

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
