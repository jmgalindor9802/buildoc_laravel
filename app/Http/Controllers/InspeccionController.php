<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\GiiInspeccion;
use Carbon\Carbon;
use App\Models\Usuario;
use App\Models\UsuariosGiiInspecciones;
use Illuminate\Support\Facades\DB;

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
    { {
            $request->validate([
                'proyecto_inspeccion' => 'required',
                'nombre_Inspeccion' => 'required',
                'insPeriodicidad' => 'required',
                'fourmulario_inspeccion' => 'required',
                'descripcionInspeccion' => 'required',
            ]);

            $Proyecto = $request->input('proyecto_inspeccion');
            $nomInspeccion = $request->input('nombre_Inspeccion');
            $insperiodicidad = $request->input('insPeriodicidad');
            $EstadoIns = 'PENDIENTE';
            $insFormulario = $request->input('fourmulario_inspeccion');
            $insFechaUnica = $request->input('fecha_unica_inspeccion');
            $insFechaInicial = $request->input('fechaInicialInspeccion');
            $insFechaFinal = $request->input('fechaFinalInspeccion');
            $insDescripcion = $request->input('descripcionInspeccion');
            $inspector = null;
            $autor = (int) '1011234567';

            if (strtoupper($insperiodicidad) == 'NINGUNA') {
                $fechaUsar = $insFechaUnica;
                $insFechaFinal = $insFechaUnica;
            } else {
                $fechaUsar = $insFechaInicial;
            }

            DB::beginTransaction();

            try {
                $inspeccion = GiiInspeccion::create([
                    'insNombre' => $nomInspeccion,
                    'insDescripcion' => $insDescripcion,
                    'insEstado' => $EstadoIns,
                    'insFecha_inicial' => $fechaUsar,
                    'insPeriodicidad' => $insperiodicidad,
                    'insFecha_final' => $insFechaFinal,
                    'fk_id_usuario' => $autor,
                    'fk_id_proyecto' => $Proyecto,
                ]);
                $lastInspeccionId = $inspeccion->pk_id_inspeccion;
                if ($request->has('usuarios_proyecto') && !empty($request->input('usuarios_proyecto'))) {
                    $usuariosAsignados = $request->input('usuarios_proyecto');
                    foreach ($usuariosAsignados as $idUsuario) {
                        UsuariosGiiInspecciones::create([
                            'fk_id_usuario' => $idUsuario,
                            'fk_id_inspeccion' => $lastInspeccionId,
                        ]);
                    }
                }
                DB::commit();
                return redirect()->route('inspecciones.dashboard')->with('success', 'Inspección creada exitosamente.');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withInput()->withErrors(['error' => 'Error al procesar la solicitud.']);
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
        $inspeccion = GiiInspeccion::findOrFail($id);
        $proyectos = Proyecto::orderBy('proNombre')->get();
        $usuarios = Usuario::orderByRaw("CONCAT(usuNombre, ' ', usuApellido)")->get();
        return view('gestionInspeccion&Incidente.actualizarInspeccionProgramada', compact('inspeccion', 'proyectos', 'usuarios'));
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
        $inspeccion = GiiInspeccion::findOrFail($id);
        $inspeccion->delete();
        return redirect()->route('inspecciones.dashboard')->with('success', 'Inspeccion eliminado exitosamente.');
    }
}
