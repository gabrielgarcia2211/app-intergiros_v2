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
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('solicitud_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned()->nullable();
            $table->string('comentarios')->nullable();
            $table->json('opciones');
            $table->string('path_estado_cuenta', 255)->nullable();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('beneficiario_id')->references('id')->on('terceros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
