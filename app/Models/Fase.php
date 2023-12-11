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
    return $this->belongsTo(Proyecto::class, 'fk_id_proyecto', 'pk_id_proyecto');
}
public function tareas()
{
    return $this->hasMany(Tarea::class, 'fk_id_fase', 'pk_id_fase');
}
    
}
