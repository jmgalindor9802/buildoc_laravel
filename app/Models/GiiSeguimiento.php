<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GiiSeguimiento extends Model
{
    use HasFactory;
    // Configuracion
    protected $table = 'gii_seguimiento';
    protected $primaryKey = 'pk_id_seguimiento';
    public $timestamps = false;

    protected $fillable = [
        'actDescripcion',
        'actSugerencia',
        'fk_id_incidente',
    ];
    // Relacion
    public function incidente()
    {
        return $this->belongsTo(GiiIncidente::class, 'fk_id_incidente', 'pk_id_incidente');
    }

    // Relación con los archivos asociados al seguimiento
    public function archivos()
    {
        return $this->belongsToMany(GaArchivo::class, 'ga_archivos_gii_seguimientos', 'fk_id_seguimiento', 'fk_id_archivo')
            ->withTimestamps();
    }
}
