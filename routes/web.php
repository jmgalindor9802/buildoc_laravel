
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\InspeccionController;


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
Route::get('/inspeccion-dashboard', [InspeccionController::class, 'inspeccionDashboard'])->name('inspecciones.dashboard');
Route::get('/inspeccion-dashboard/programar-inspeccion', [InspeccionController::class, 'programarInspeccion'])->name('programar.inspeccion');
