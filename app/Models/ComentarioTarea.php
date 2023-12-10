<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioTarea extends Model
{
    use HasFactory;

    // Relacion
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario', 'pk_id_usuario');
    }

    // Relación con la tarea a la que pertenece el comentario
    public function tarea()
    {
        return $this->belongsTo(GtTarea::class, 'fk_id_tarea', 'pk_id_tarea');
    }
}
