<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosGtTareas extends Model
{
   // la tabla usuarios_gt_tareas tiene claves foráneas 'fk_id_usuario' y 'fk_id_tarea'
   protected $primaryKey = 'fk_id_usuario';

   // Relación muchos a uno con el modelo Tarea
   public function tarea()
   {
       return $this->belongsTo(Tarea::class, 'fk_id_tarea', 'pk_id_tarea');
   }

   // Relación muchos a uno con el modelo Usuario
   public function usuario()
   {
       return $this->belongsTo(Usuario::class, 'fk_id_usuario', 'pj_id_usuario');
   }
}
