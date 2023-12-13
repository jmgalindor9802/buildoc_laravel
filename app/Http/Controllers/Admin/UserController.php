<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $usuarios = User::all();
        return view('gestionSistema\users\index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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
        $usuario=User::find($id);
        return view('gestionSistema\users\editarUser',compact('usuario'));
     
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
        $usuario=User::find($id);

                $usuario->pk_id_usuario =$request->input('Cedula');
                $usuario->usuNombre =$request->input('NombreUsu');
                $usuario->usuApellido =$request->input('ApellidoUsu');
                $usuario->usuNombre_eps =$request->input('EPS');
                $usuario->usuNombre_arl =$request->input('ARL');
                $usuario->usuFecha_nacimiento =$request->input('FechaNacimiento');
                $usuario->usuMunicipio =$request->input('MunicipioUsu');
                $usuario->usuDireccion_residencia =$request->input('DireccionUsu');
                $usuario->usuProfesion =$request->input('ProfesionUsu');
                $usuario->password =$request->input('ContraseniaUsu');
                $usuario->usuTelefono=$request->input('TelefonoUsu');
                $usuario->email=$request->input('CorreoUsu');

                $usuario->save();
                return back()->with('message','Actualizado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return back();
    }
}
