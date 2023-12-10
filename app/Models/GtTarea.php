<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtTarea extends Model
{
    protected $table='gt_tarea';
    public $timestamps = false;

    // Relacion
    public function fase()
    {
        return $this->belongsTo(Fase::class, 'fk_id_fase');
    }
    public function comentarios()
    {
        return $this->hasMany(ComentarioTarea::class, 'fk_id_tarea');
    }
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarios_gt_tareas', 'fk_id_tarea', 'fk_id_usuario');
    }
    public function dependencias()
    {
        return $this->hasMany(GtDependenciaTareas::class, 'depTareaPrincipal', 'pk_id_tarea');
    }
    public function dependientes()
    {
        return $this->hasMany(GtDependenciaTareas::class, 'depTareaDependiente', 'pk_id_tarea');
    }
    public function archivos()
    {
        return $this->belongsToMany(GaArchivo::class, 'ga_archivos_gt_tareas', 'fk_id_tarea', 'fk_id_archivo');
    }
}
