<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_insert_solicitud
            AFTER INSERT ON solicitudes
            FOR EACH ROW
            BEGIN
                IF NEW.notificacion = 1 THEN
                    INSERT INTO solicitud_notificacion_logs (`read`, `delete`, solicitud_id, estado_id, accion, created_at)
                    VALUES (1, 0, NEW.id, NEW.estado_id, "CREATE", NOW());
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER after_update_solicitud
            AFTER UPDATE ON solicitudes
            FOR EACH ROW
            BEGIN 
                IF NEW.notificacion = 1 AND NEW.estado_id <> OLD.estado_id THEN
                    INSERT INTO solicitud_notificacion_logs (`read`, `delete`, solicitud_id, estado_id, accion, created_at)
                    VALUES (1, 0, NEW.id, NEW.estado_id, "UPDATE", NOW());
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_solicitud');
        DB::unprepared('DROP TRIGGER IF EXISTS after_update_solicitud');
    }
};
