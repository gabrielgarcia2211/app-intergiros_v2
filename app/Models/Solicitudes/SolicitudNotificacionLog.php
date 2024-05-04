<?php

namespace App\Models\Solicitudes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudNotificacionLog extends Model
{
    protected $table = 'solicitud_notificacion_logs';

    protected $fillable = [
        'read',
        'delete',
        'estado_id',
        'solicitud_id',
        'accion',
    ];
}
