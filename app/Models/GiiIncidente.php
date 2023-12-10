<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiiIncidente extends Model
{
    use HasFactory;

    protected $table = 'gii_incidente';

    public $timestamps = false;
    protected $PrimaryKey = 'pk_id_incidente';

    

}
