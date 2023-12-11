<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table='gt_fase';
    public $timestamps = false;
    protected $primaryKey = 'pk_id_fase';

    // Relacion
    public function proyecto()
{
    return $this->belongsTo(Proyecto::class, 'fk_id_proyecto');
}
    public function tarea()
    {
        return $this->hasMany(Tarea::class, 'fase_id', 'pk_id_fase');
    }
    
}
