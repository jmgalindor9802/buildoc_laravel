<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\GiiIncidente;
use App\Models\GiiSeguimiento;
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
        // Validar el formulario aquí si es necesario
        $request->validate([
            'Nombre_incidente' => 'required',
            'Proyecto_incidente' => 'required',
            'Descripcion_incidente' => 'required',
            'Gravedad_incidente' => 'required',
            // Añade otras reglas de validación según sea necesario
        ]);

        // Crear un nuevo incidente
        $incidente = GiiIncidente::create([
            'incNombre' => $request->input('Nombre_incidente'),
            'incDescripcion' => $request->input('Descripcion_incidente'),
            'incEstado' => 'INICIALIZADO',
            'incGravedad' => $request->input('Gravedad_incidente'),
            'incSugerencias' => $request->input('Sugerencia_incidente'),
            'fk_id_usuario' => 1011234567, // Reemplaza esto con la lógica para obtener el autor
            'fk_id_proyecto' => $request->input('Proyecto_incidente'),
        ]);

        // Obtener el ID del nuevo incidente
        $lastIncidenteId = $incidente->pk_id_incidente;

        // Llamar al método del controlador de Involucrado para almacenar involucrados
        app(InvolucradoController::class)->store($request, $lastIncidenteId);

        return redirect()->route('incidentes.dashboard')->with('success', 'Incidente reportado exitosamente.');
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
        // Obtener el incidente que se va a editar
        $incidente = GiiIncidente::findOrFail($id);
        $proyectos = Proyecto::orderBy('proNombre')->get();

        return view('gestionInspeccion&Incidente.seguimientoIncidente', compact('incidente', 'proyectos'));
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
        // Validar el formulario aquí si es necesario
        $request->validate([
            'Descripcion_incidente' => 'required',
            'Sugerencia_incidente' => 'required',
            // Agrega otras reglas de validación según sea necesario
        ]);

        // Obtener el incidente que se va a actualizar
        $incidente = GiiIncidente::findOrFail($id);

        // Almacenar un nuevo seguimiento
        $seguimiento = GiiSeguimiento::create([
            'actDescripcion' => $request->input('Descripcion_incidente'),
            'actSugerencia' => $request->input('Sugerencia_incidente'),
            'fk_id_incidente' => $incidente->pk_id_incidente,
        ]);

        // Llamar al método del controlador de Involucrado para almacenar nuevos involucrados
        app(InvolucradoController::class)->update($request, $incidente->pk_id_incidente);

        return redirect()->route('incidentes.dashboard')->with('success', 'Seguimiento guardado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incidente = GiiIncidente::findOrFail($id);
        $incidente->delete();
        return redirect()->route('incidentes.dashboard')->with('success', 'Incidente eliminado exitosamente.');
    }
}
