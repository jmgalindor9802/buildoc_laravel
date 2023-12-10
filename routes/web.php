
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\InspeccionController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\ClienteController;


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
Route::get('/fase', [FaseController::class, 'index'])->name('crear.fase');
Route::get('/tarea/creartarea', [TareaController::class, 'create'])->name('crear.tarea');
Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.dashboard');
Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('cliente.crear');