<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosGiiInspecciones extends Model
{
    use HasFactory;
    // Configuracion
    protected $table = 'usuarios_gii_inspecciones';
    public $timestamps = false;
    protected $fillable = [
        'fk_id_usuario',
        'fk_id_inspeccion',
        // Otros campos si los tienes
    ];

    // Relacion
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario', 'pk_id_usuario');
    }

    // Relación con la inspección asociada al usuario
    public function inspeccion()
    {
        return $this->belongsTo(GiiInspeccion::class, 'fk_id_inspeccion', 'pk_id_inspeccion');
    }
}
