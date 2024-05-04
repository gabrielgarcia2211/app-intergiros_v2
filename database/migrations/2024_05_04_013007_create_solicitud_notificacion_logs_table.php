<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitud_notificacion_logs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('read')->default(0);
            $table->tinyInteger('delete')->default(0);
            $table->integer('estado_id')->unsigned()->nullable();
            $table->unsignedBigInteger('solicitud_id');
            $table->enum('accion', ['CREATE', 'UPDATE']);
            $table->timestamps();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('estado_id')->references('id')->on('master_combos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_notificacion_logs');
    }
};
