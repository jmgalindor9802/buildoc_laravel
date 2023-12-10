<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    // Configuracion de la tabla
    protected $table = 'usuario';
    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_usuario';

    // Relaciones
    public function carpetas() {
        return $this->hasMany(GaArchivoVersion::class, 'fk_id_usuario', 'pk_id_usuario');
    }
    public function archivos() {
        return $this->hasMany(GaArchivo::class, 'fk_id_usuario');
    }
    public function comentariosArchivos() {
        return $this->hasMany(ComentarioArchivo::class, 'fk_id_usuario');
    }
    public function inspecciones() {
        return $this->belongsToMany(GiiInspeccion::class, 'usuarios_gii_inspecciones', 'fk_id_usuario', 'fk_id_inspeccion');
    }
    public function proyectos() {
        return $this->belongsToMany(GaProyecto::class, 'usuarios_proyectos', 'fk_id_usuario', 'fk_id_proyecto');
    }
    public function tareas() {
        return $this->belongsToMany(GtTarea::class, 'usuarios_gt_tareas', 'fk_id_usuario', 'fk_id_tarea');
    }
}
