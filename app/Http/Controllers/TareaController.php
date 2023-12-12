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
    $tareas = Tarea::orderBy('tarFecha_limite','asc')->paginate(5);
    $tareasConsultas =  DB::table('gt_tarea')
    ->select(
        'gt_tarea.pk_id_tarea',
        'gt_tarea.tarNombre',
        'gt_tarea.tarDescripcion',
        'gt_tarea.tarPrioridad',
        'gt_tarea.tarEstado',
        'gt_tarea.tarFecha_creacion',
        'gt_tarea.tarFecha_limite',
        'ga_proyecto.proNombre AS nombre_proyecto',
        'gt_fase.fasNombre AS nombre_fase',
        DB::raw('CONCAT(usuario.usuNombre, " ", usuario.usuApellido) AS nombre_completo')
    )
    ->join('gt_fase', 'gt_tarea.fk_id_fase', '=', 'gt_fase.pk_id_fase')
    ->join('ga_proyecto', 'gt_fase.fk_id_proyecto', '=', 'ga_proyecto.pk_id_proyecto')
    ->join('usuarios_gt_tareas', 'gt_tarea.pk_id_tarea', '=', 'usuarios_gt_tareas.fk_id_tarea')
    ->join('usuario', 'usuario.pk_id_usuario', '=', 'usuarios_gt_tareas.fk_id_usuario')
    ->get();
    return view('gestionTareas.Tareadashboard', compact('tareas', 'tareasConsultas'));
}
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
    public function consutarTarea(Request $request){
        $request->validate([
            'proyectoNombre' => 'required',
            'FaseNombre' => 'required',
        ]);

        $proyecto = $request->input('proyectoNombre');
        $fase = $request->input('FaseNombre');

        $listarTareas = DB::select('CALL ListarTareasPorFaseYProyecto(?,?)', [$fase, $proyecto]);
        return view('gestionTareas.consultarTareas', compact('listarTareas'));
    }
}
