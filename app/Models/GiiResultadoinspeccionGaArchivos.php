<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiiResultadoinspeccionGaArchivos extends Model
{
    use HasFactory;
    // Configuracion
    protected $table = 'gii_resultadoinspeccion_ga_archivos';
    protected $primaryKey = null; // Al ser una tabla pivote, no tiene clave primaria propia
    public $timestamps = false;

    // Relacion
    public function resultadoInspeccion()
    {
        return $this->belongsTo(GiiResultadoInspeccion::class, 'fk_id_resultado_inspeccion', 'pk_id_resultado_inspeccion');
    }

    // Relación con el archivo asociado al resultado de inspección
    public function archivo()
    {
        return $this->belongsTo(GaArchivo::class, 'fk_id_archivo', 'pk_id_archivo');
    }
}
