<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncidenteController extends Controller
{
    public function incidenteDashboard()
    {
        return view('gestionInspeccion&Incidente.incidenteDashboard');
    }
}
