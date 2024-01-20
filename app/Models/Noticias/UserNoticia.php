<?php

namespace App\Models\Noticias;

use Illuminate\Database\Eloquent\Model;

class UserNoticia extends Model
{
    protected $table = 'users_noticias';

    protected $fillable = [
        'user_id',
        'noticia_id',
        'visible'
    ];

    const RELATIONS = [];

}
