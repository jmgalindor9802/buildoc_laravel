<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiiResultadoinspeccion extends Model
{
    use HasFactory;
    // Configuracion
    protected $table = 'gii_resultadoinspeccion';
    protected $primaryKey = 'pk_id_resultado_inspeccion';
    public $timestamps = false;

    // Relacion
    public function inspeccion()
    {
        return $this->belongsTo(GiiInspeccion::class, 'fk_id_inspeccion', 'pk_id_inspeccion');
    }

    // Relación con los archivos asociados al resultado de la inspección
    public function archivos()
    {
        return $this->belongsToMany(GaArchivo::class, 'gii_resultadoinspeccion_ga_archivos', 'fk_id_resultado_inspeccion', 'fk_id_archivo')
            ->withPivot('fk_id_resultado_inspeccion', 'fk_id_archivo')
            ->withTimestamps();
    }
}
