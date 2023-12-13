<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Fase;
use App\Models\Tarea;
use App\Models\Usuario;
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
    $tareas = Tarea::all();
    return view('gestionTareas.Tareadashboard', compact('tareas'));
}
    public function create()
    {
        $usuarios = Usuario::all();
        $proyectos = Proyecto::orderBy('proNombre')->get();
        $fases = Fase::orderBy('fasNombre')->get();

    // Pasar proyectos y fases a la vista
    return view('gestionTareas.createTarea', compact('proyectos', 'fases', 'usuarios'));
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
        return redirect()->route('tarea.dashboard')->with(['success' => 'Tarea creada exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Tarea::find($id);
        return view('gestionTareas.eliminarTarea', compact('tarea'));
    }

    public function edit($id)
    {
        $tarea = Tarea::find($id);
        
        return view('gestionTareas.editTarea', compact('tarea'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'tarNombre' => 'required|string|max:255',
            'tarDescripcion' => 'required|string|max:450',
            'tarPrioridad' => 'required|in:ALTA,BAJA',
            'tarFechaLimite' => 'required|date',
        ]);

        $tarea = Tarea::find($id);

        $tarea->tarNombre = $request->tarNombre;
        $tarea->tarDescripcion = $request->tarDescripcion;
        $tarea->tarPrioridad = $request->tarPrioridad;
        $tarea->tarFecha_limite  = $request->tarFechaLimite;

        $tarea->save();

        return redirect()->route('tarea.dashboard')->with('success', 'Tarea actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id);
        $tarea->delete();
        return redirect()->route('tarea.dashboard')->with('success', 'Tarea eliminada exitosamente');
    }
    public function listarTareasPendientesProximos7Dias(Request $request){
        $request->validate([
            'proyectoNombre' => 'required',
        ]);

        $proyecto = $request->input('proyectoNombre');

        $listarTareas = DB::select('CALL listar_tareas_pendientes_proximos_7_dias_por_proyecto(?)', [$proyecto]);
        return view('gestionTareas.consultarTareas', compact('listarTareas'));
    }
    public function listarTareasPorUsuarioProyecto(Request $request){
        $request->validate([
            'usuarioId' => 'required',
            'proyectoNombre' => 'required',
        ]);

        $usuarioId = $request->input('usuarioId');
        $proyecto = $request->input('proyectoNombre');

        $listarTareasUsuarioProyectos = DB::select('CALL listar_tareas_por_usuario_por_proyecto(?,?)', [$usuarioId, $proyecto]);
        return view('gestionTareas.consultarTareasPorUsuarioProyecto', compact('listarTareasUsuarioProyectos', 'proyecto', 'usuarioId'));
    }
}
