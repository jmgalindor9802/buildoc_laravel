<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaArchivo extends Model
{
    use HasFactory;
    // Configuracion de la tabla
    protected $table = 'ga_archivo';
    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_archivo';

    // Relacion
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario');
    }
    
    public function carpeta()
    {
        return $this->belongsTo(GaCarpeta::class, 'fk_id_carpeta');
    }
    
    public function versiones()
    {
        return $this->hasMany(GaArchivoVersion::class, 'verArchivoOriginal');
    }

    public function version()
    {
        return $this->hasOne(GaArchivoVersion::class, 'verArchivoVersion');
    }
    
    public function comentarios()
    {
        return $this->hasMany(ComentarioArchivo::class, 'fk_id_archivo');
    }
    
    public function inspecciones()
    {
        return $this->belongsToMany(GiiInspeccion::class, 'ga_archivos_gii_inspecciones', 'fk_id_archivo', 'fk_id_inspeccion');
    }

    public function tareas()
    {
        return $this->belongsToMany(GtTarea::class, 'ga_archivos_gt_tareas', 'fk_id_archivo', 'fk_id_tarea');
    }

    public function incidentes()
    {
        return $this->belongsToMany(GiiIncidente::class, 'ga_archivos_gii_incidentes', 'fk_id_archivo', 'fk_id_incidente');
    }
}
