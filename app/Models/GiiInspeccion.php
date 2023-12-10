<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GiiInspeccion extends Model
{
    use HasFactory;
    // configuracion
    protected $table = 'gii_inspeccion';
    public $timestamps = false;
    protected $primaryKey = 'pk_id_inspeccion';

    // Relacion
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario');
    }
    public function proyecto() {
        return $this->belongsTo(Proyecto::class, 'fk_id_proyecto');
    }
    public function resultadosInspeccion() {
        return $this->hasMany(GiiResultadoInspeccion::class, 'fk_id_inspeccion');
    }
    public function usuarios() {
        return $this->belongsToMany(Usuario::class, 'usuarios_gii_inspecciones', 'fk_id_inspeccion', 'fk_id_usuario');
    }

}
