<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtDependenciaTareas extends Model
{
    use HasFactory;

    // Relacion
    public function tareaPrincipal()
    {
        return $this->belongsTo(GtTarea::class, 'depTareaPrincipal', 'pk_id_tarea');
    }
    public function tareaDependiente()
    {
        return $this->belongsTo(GtTarea::class, 'depTareaDependiente', 'pk_id_tarea');
    }
}
