<?php

namespace App\Models\Registro;

use Illuminate\Database\Eloquent\Model;

class UserRedes extends Model
{
    protected $table = 'users_redes';

    protected $fillable = [
        'user_id',
        'redes_id',
        'nombre',
    ];
}
