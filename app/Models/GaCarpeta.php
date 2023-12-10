<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaCarpeta extends Model
{
    use HasFactory;
    // Configuracion de la tabla
    protected $table = 'ga_carpeta';
    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_carpeta';

    // Relaciones
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario');
    }
    public function proyecto() {
        return $this->belongsTo(GaProyecto::class, 'fk_id_proyecto');
    }
    public function archivos() {
        return $this->hasMany(GaArchivo::class, 'fk_id_carpeta');
    }
}
