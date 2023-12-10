<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaArchivoVersion extends Model
{
    use HasFactory;
    // Configuracion de la tabla
    protected $table = 'ga_archivoVersion';
    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_version';

    // Relacion
    public function archivoOriginal() {
        return $this->belongsTo(GaArchivo::class, 'verArchivoOriginal');
    }
    
    public function archivoVersion() {
        return $this->belongsTo(GaArchivo::class, 'verArchivoVersion');
    }
}
