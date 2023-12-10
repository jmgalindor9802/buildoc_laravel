<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaCliente extends Model
{
    use HasFactory;
    // Configuracion de la tabla
    protected $table = 'ga_cliente';
    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_cliente';

    // Relaciones
    public function proyectos() {
        return $this->hasMany(GaProyecto::class, 'fk_id_cliente');
    }
    public function usuarios() {
        return $this->belongsToMany(Usuario::class, 'usuarios_proyectos', 'fk_id_cliente', 'fk_id_usuario');
    }
    
}
