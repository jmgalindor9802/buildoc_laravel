<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class Usuario extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use HasFactory;

    // Configuracion de la tabla
    protected $table = 'usuario';
    protected $primaryKey = 'pk_id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pk_id_usuario',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return 'Administrador';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }

    // Relaciones
    public function carpetas()
    {
        return $this->hasMany(GaArchivoVersion::class, 'fk_id_usuario', 'pk_id_usuario');
    }

    public function archivos()
    {
        return $this->hasMany(GaArchivo::class, 'fk_id_usuario');
    }

    public function comentariosArchivos()
    {
        return $this->hasMany(ComentarioArchivo::class, 'fk_id_usuario');
    }

    public function inspecciones()
    {
        return $this->belongsToMany(GiiInspeccion::class, 'usuarios_gii_inspecciones', 'fk_id_usuario', 'fk_id_inspeccion');
    }

public function tareasGtUsuarios()
{
    return $this->belongsToMany(Tarea::class, 'usuarios_gt_tareas', 'fk_id_usuario', 'fk_id_tarea', 'pk_id_usuario', 'pk_id_tarea');
}


    public function proyectosUsuarios()
    {
        return $this->belongsToMany(Proyecto::class, 'usuarios_proyectos', 'fk_id_usuario', 'fk_id_proyecto');
    }
    public function nombreCompleto()
    {
        return $this->usuNombre . ' ' . $this->usuApellido;
    }
}
