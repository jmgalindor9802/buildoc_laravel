<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'gt_tarea';
    protected $primaryKey = 'pk_id_tarea';
    public $timestamps = false;

    // Relacion
    public function comentarios()
    {
        return $this->hasMany(ComentarioTarea::class, 'fk_id_tarea');
    }

       // Relación muchos a uno con la tabla usuarios_gt_tareas
       public function usuariosGtTareas()
       {
           return $this->hasMany(UsuariosGtTareas::class, 'fk_id_tarea', 'pk_id_tarea');
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

    public function fase()
    {
        return $this->belongsTo(Fase::class, 'fk_id_fase', 'pk_id_fase');
    }

      // Define la relación proyecto a través de la relación fase
      public function proyecto()
        {
            return $this->belongsTo(Proyecto::class, 'fk_id_proyecto', 'pk_id_proyecto');
        }

  
      // Método accessor para acceder al proyecto a través de la fase

   

      // Relación muchos a muchos con el modelo Usuario
      public function responsables()
      {
          return $this->belongsToMany(Usuario::class, 'usuarios_gt_tareas', 'fk_id_tarea', 'fk_id_usuario', 'pk_id_tarea', 'pk_id_usuario');
      }


  
}
