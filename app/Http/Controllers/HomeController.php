<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Fase;
use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Datos para la gráfica de Tareas por Proyecto
        $proyectos = Proyecto::all();
        $proyectosConTareas = [];
        $numeroDeTareas = [];

        foreach ($proyectos as $proyecto) {
            $tareas = Tarea::whereHas('fase.proyecto', function ($query) use ($proyecto) {
                $query->where('pk_id_proyecto', $proyecto->pk_id_proyecto);
            })->count();

            $proyectosConTareas[] = $proyecto->proNombre;
            $numeroDeTareas[] = $tareas;
        }

        // Datos para la gráfica de Usuarios por Proyecto
    $proyectosConUsuarios = Proyecto::select('ga_proyecto.pk_id_proyecto', 'ga_proyecto.proNombre', DB::raw('COUNT(usuarios_proyectos.fk_id_usuario) as cantidad_usuarios'))
    ->leftJoin('usuarios_proyectos', 'ga_proyecto.pk_id_proyecto', '=', 'usuarios_proyectos.fk_id_proyecto')
    ->groupBy('ga_proyecto.pk_id_proyecto', 'ga_proyecto.proNombre')
    ->get();

$proyectos = $proyectosConUsuarios->pluck('proNombre');
$cantidadUsuarios = $proyectosConUsuarios->pluck('cantidad_usuarios');

        return view('home', compact('proyectosConTareas', 'numeroDeTareas', 'proyectos','cantidadUsuarios'));
    }
    }

