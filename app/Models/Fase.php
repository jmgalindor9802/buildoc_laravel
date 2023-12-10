<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table='gt_fase';
    public $timestamps = false;

    // Relacion
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'fk_id_proyecto');
    }
    public function tareas()
    {
        return $this->hasMany(GtTarea::class, 'fk_id_fase');
    }
}
