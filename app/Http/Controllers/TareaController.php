<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Fase;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Utilizar Eloquent para cargar las relaciones
    $tareas = Tarea::with(['fase.proyecto'])->get();

   

    // Formatear fechas usando Carbon
    foreach ($tareas as $tarea) {
        $tarea->tarFecha_creacion = Carbon::parse($tarea->tarFecha_creacion)->format('j M Y');
        $tarea->tarFecha_limite = Carbon::parse($tarea->tarFecha_limite)->format('j M Y');
    }

    return view('gestionTareas.Tareadashboard', compact('tareas'));


    
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

    
       return redirect()->route('tarea.dashboard')->with('success', 'Tarea creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('eliminarTarea');
    }

    

    public function edit($id)
    {
        $tarea = Tarea::find($id);
        $proyectos = Proyecto::orderBy('proNombre')->get();
        $fases = Fase::orderBy('fasNombre')->get();

        return view('gestionTareas.editTarea', compact('tarea', 'proyectos', 'fases'));
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
        $request->validate([
            'tarNombre' => 'required|string|max:255',
            'tarDescripcion' => 'required|string|max:450',
            'tarPrioridad' => 'required|in:ALTA,BAJA',
            'tarFechaLimite' => 'required|date',
            'tarProyecto' => 'required|exists:proyectos,pk_id_proyecto',
            'tarFase' => 'required|exists:fases,pk_id_fase',
        ]);

        $tarea = Tarea::find($id);

        $tarea->tarNombre = $request->tarNombre;
        $tarea->tarDescripcion = $request->tarDescripcion;
        $tarea->tarPrioridad = $request->tarPrioridad;
        $tarea->tarFechaLimite = $request->tarFechaLimite;
        $tarea->fk_id_fase = $request->tarFase;

        // Puedes asignar el proyecto directamente o guardar la relación según tu modelo
        $tarea->fk_id_proyecto = $request->tarProyecto;

        $tarea->save();

        return redirect()->route('tarea.index')->with('success', 'Tarea actualizada exitosamente');
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
