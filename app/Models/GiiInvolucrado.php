<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiiInvolucrado extends Model
{
    use HasFactory;
    // Configuracion
    protected $table = 'gii_involucrado';
    protected $primaryKey = 'pk_id_involucrado';
    public $timestamps = false;
    protected $fillable = ['invNombre', 'invApellido', 'invNumDocumento', 'invJustificacion', 'fk_id_incidente'];

    // Relacion
    public function incidente()
    {
        return $this->belongsTo(GiiIncidente::class, 'fk_id_incidente', 'pk_id_incidente');
    }
}
