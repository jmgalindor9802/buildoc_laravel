
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
Route::get('/incidente-dashboard', [IncidenteController::class, 'incidenteDashboard'])->name('incidentes.dashboard');
Route::get('/inspeccion-dashboard', [InspeccionController::class, 'inspeccionDashboard'])->name('inspecciones.dashboard');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
