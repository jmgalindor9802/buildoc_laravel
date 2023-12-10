<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioArchivo extends Model
{
    use HasFactory;
    // Configuracion de la tabla
    protected $table = 'comentario_archivo';
    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_comentario_archivo';

    // Relacion
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario');
    }
}
