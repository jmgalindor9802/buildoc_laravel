<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspeccionController extends Controller
{
    public function inspeccionDashboard()
    {
        return view('gestionInspeccion&Incidente.inspeccionDashboard');
    }
    public function programarInspeccion()
    {
        return view('gestionInspeccion&Incidente.programarInspeccion');
    }
}
