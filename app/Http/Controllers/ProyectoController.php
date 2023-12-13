<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Usuario;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('gestionSistema.proyectoDashboard', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyectos = Proyecto::all();
        $usuarios = Usuario::all();
        return view('gestionSistema.crearProyecto', compact('proyectos', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ProyectoNombre' => 'required',
            'ProyectoMunicipio' => 'required',
            'ProyectoDireccion' => 'required',
            'ProyectoDescripcion' => 'required',
            'ProyectoCliente' => 'required',
        ]);
        $nombre = $request->input("ProyectoNombre");
        $municipio = $request->input("ProyectoMunicipio");
        $direccion = $request->input("ProyectoDireccion");
        $descripcion = $request->input("ProyectoDescripcion");
        $cliente = $request->input("ProyectoCliente");

        // Consulta para verificar si el proyecto ya existe
        $proyectoExistente = Proyecto::where('proNombre', $nombre)->first();

        if ($proyectoExistente) {
            // El proyecto ya existe, manejar según sea necesario
            return redirect()->back()->with('error', 'El proyecto ya existe.');
        }

        // Insertar el proyecto principal
        $proyecto = new Proyecto();
        $proyecto->proNombre = $nombre;
        $proyecto->proMunicipio = $municipio;
        $proyecto->proDireccion = $direccion;
        $proyecto->proDescripcion = $descripcion;
        $proyecto->fk_id_cliente = $cliente;
        $proyecto->save();

        $id_proyecto = $proyecto->id;

        // Insertar usuarios seleccionados en la tabla intermedia
        if ($request->has("usuarios_proyecto") && is_array($request->input("usuarios_proyecto"))) {
            $usuarios_asignados = $request->input("usuarios_proyecto");

            foreach ($usuarios_asignados as $id_usuario) {
                // Asumo que tienes una tabla pivot llamada "usuario_proyecto" para la relación muchos a muchos
                $proyecto->usuarios()->attach($id_usuario);
            }
        }
        return redirect()->route('proyecto.dashboard')->with('success', 'Proyecto creado exitosamente.');
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
        $proyecto = Proyecto::find($id);
        $proyecto->delete();
        return back();
    }
}
