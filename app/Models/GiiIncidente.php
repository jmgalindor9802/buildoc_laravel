<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiiIncidente extends Model
{
    use HasFactory;

    protected $table = 'gii_incidente';
    public $timestamps = false;
    protected $primaryKey = 'pk_id_incidente';
    protected $fillable = [
        'incNombre',
        'incDescripcion',
        'incEstado',
        'incGravedad',
        'incSugerencias',
        'fk_id_usuario',
        'fk_id_proyecto',
        // Agrega aquí otros campos si es necesario
    ];
    
    // Relacion
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'fk_id_usuario');
    }
    public function proyecto() {
        return $this->belongsTo(Proyecto::class, 'fk_id_proyecto');
    }
    public function seguimientos() {
        return $this->hasMany(GiiSeguimiento::class, 'fk_id_incidente');
    }
    public function involucrados() {
        return $this->hasMany(GiiInvolucrado::class, 'fk_id_incidente');
    }
}