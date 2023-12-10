<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\InspeccionController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('index');
});

Route::get('formulario',function(){
    return view('formularioview');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/incidentes', [IncidenteController::class, 'index'])->name('incidentes.dashboard');
Route::get('/incidentes/reportar-incidente', [IncidenteController::class, 'create'])->name('reportar.incidente');
Route::post('/incidentes', [IncidenteController::class, 'store'])->name('incidentes.store');
Route::get('/inspeccion', [InspeccionController::class, 'index'])->name('inspecciones.dashboard');
Route::get('/inspeccion/programar-inspeccion', [InspeccionController::class, 'create'])->name('programar.inspeccion');
Route::post('/inspeccion', [IncidenteController::class, 'store'])->name('inspeccion.store');

Route::get('/tarea', [TareaController::class, 'index'])->name('tarea.dashboard');
Route::get('/tarea/creartarea', [TareaController::class, 'create'])->name('crear.tarea');
Route::get('/tarea/fases/{proyectoId}', [TareaController::class, 'getFasesByProyecto']);
Route::post('/tarea/creartarea/guardar', [FaseController::class, 'store'])->name('tarea.store');


Route::get('/fase', [FaseController::class, 'create'])->name('crear.fase');
Route::post('/fase/guardar', [FaseController::class, 'store'])->name('fase.store');


Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.dashboard');
Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('cliente.crear');
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyecto.dashboard');
Route::get('/proyectos/crearproyecto', [ProyectoController::class, 'create'])->name('proyecto.crear');
