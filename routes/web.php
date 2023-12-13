<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\InspeccionController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\Admin\UserController;



Route::get('/', function () {
    return view('index');
});

Route::get('formulario',function(){
    return view('formularioview');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/incidentes', [IncidenteController::class, 'index'])->name('incidentes.dashboard');
Route::get('/incidentes/reportarincidente', [IncidenteController::class, 'create'])->name('reportar.incidente');
Route::post('/incidentes/guardarincidente', [IncidenteController::class, 'store'])->name('incidentes.store');
Route::get('/incidentes/editar/{id}', [IncidenteController::class, 'edit'])->name('incidentes.edit');
Route::put('/incidentes/{id}', [IncidenteController::class, 'update'])->name('incidentes.update');
Route::delete('/incidentes/{id}', [IncidenteController::class, 'destroy'])->name('incidentes.destroy');
Route::post('/incidentes/consultar-seguimientos', [IncidenteController::class, 'consultarSeguimientos'])->name('incidentes.consultarSeguimientos');
Route::post('/incidentes/consultar-incidente-involucrado', [IncidenteController::class, 'consultarIncidenteInvolucrados'])->name('incidentes.consultarIncidenteInvolucrado');
Route::get('/inspecciones', [InspeccionController::class, 'index'])->name('inspecciones.dashboard');
Route::get('/inspeccion/programarinspeccion', [InspeccionController::class, 'create'])->name('programar.inspeccion');
Route::post('/inspeccion', [InspeccionController::class, 'store'])->name('inspeccion.store');
Route::get('/inspeccion/editar/{id}', [InspeccionController::class, 'edit'])->name('inspecciones.edit');
Route::delete('/inspeccion/{id}', [InspeccionController::class, 'destroy'])->name('inspeccion.destroy');
//TAREAS
Route::get('/tarea', [TareaController::class, 'index'])->name('tarea.dashboard');
Route::get('/tarea/creartarea', [TareaController::class, 'create'])->name('crear.tarea');
Route::get('/tarea/mostrartarea/{id}', [TareaController::class, 'show'])->name('tarea.show');

Route::post('/tarea/creartarea/guardar', [TareaController::class, 'store'])->name('tarea.store');

//Edición
Route::get('/tarea/{id}/edit', [TareaController::class, 'edit'])->name('tarea.edit');

//Actualización de la tarea
Route::put('/tarea/{id}', [TareaController::class, 'update'])->name('tarea.update');
//elininar tarea
Route::delete('/tarea/destroy/{id}', [TareaController::class, 'destroy'])->name('tarea.destroy');

// Consultas
Route::post('/tarea/consultarTareas', [TareaController::class, 'listarTareasPendientesProximos7Dias'])->name('tareas.consultarTareasPendiente');
Route::post('/tarea/listarTareas-Usuario-Proyecto', [TareaController::class, 'listarTareasPorUsuarioProyecto'])->name('tareas.listaTareasUsuPro');
Route::get('/fase/crearfase', [FaseController::class, 'create'])->name('crear.fase');
Route::post('/fase/guardar', [FaseController::class, 'store'])->name('fase.store');


Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.dashboard');
Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('cliente.crear');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuario.dashboard');
Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuario.crear');
Route::get('/usuario/{id}/edit', [UserController::class, 'edit'])->name('usuario.edit');
Route::put('/usuario/{id}/edit', [UserController::class, 'update'])->name('usuario.update');
Route::delete('/usuarios/eliminar/{id}', [UserController::class, 'destroy'])->name('usuario.destroy');


Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyecto.dashboard');
Route::get('/proyectos/crearproyecto', [ProyectoController::class, 'create'])->name('proyecto.crear');
Route::post('/proyectos/store', [ProyectoController::class, 'store'])->name('proyecto.store');
Route::delete('/proyectos/eliminar-proyecto/{id}', [ProyectoController::class, 'destroy'])->name('proyecto.destroy');
