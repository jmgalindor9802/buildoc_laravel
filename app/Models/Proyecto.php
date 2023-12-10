<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'ga_proyecto';
    public $timestamps = false;
    protected $primaryKey = 'pk_id_proyecto';

    // Relacion
    public function cliente()
    {
        return $this->belongsTo(GaCliente::class, 'fk_id_cliente');
    }

    public function carpetas()
    {
        return $this->hasMany(GaCarpeta::class, 'fk_id_proyecto');
    }

    public function archivos()
    {
        return $this->hasMany(GaArchivo::class, 'fk_id_proyecto');
    }

    public function fases()
    {
        return $this->hasMany(GtFase::class, 'fk_id_proyecto');
    }

    public function inspecciones()
    {
        return $this->hasMany(GiiInspeccion::class, 'fk_id_proyecto');
    }

    // Agrega la relación con la tabla usuarios_proyectos
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarios_proyectos', 'fk_id_proyecto', 'fk_id_usuario');
    }
}
