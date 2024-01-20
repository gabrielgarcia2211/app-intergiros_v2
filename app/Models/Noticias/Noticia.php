<?php

namespace App\Models\Noticias;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';

    protected $fillable = [
        'titulo',
        'referencia',
        'descripcion'
    ];

    const RELATIONS = [];

    // mutadores
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');;
    }
}
