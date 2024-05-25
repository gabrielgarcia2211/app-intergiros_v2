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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidos')->nullable();
            $table->string('email');
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('pais_id')->unsigned()->nullable();
            $table->integer('pais_telefono_id')->unsigned()->nullable();
            $table->integer('tipo_documento_id')->unsigned()->nullable();
            $table->string('path_selfie')->nullable();
            $table->string('path_documento')->nullable();
            $table->string('path_foto_perfil')->nullable();
            $table->boolean('verificado')->default(false)->comment('verificado - 1, sin verificar - 0, rechazado - 2, solicitud de verificación - 3');;
            $table->foreign('pais_id')->references('id')->on('master_combos');
            $table->foreign('pais_telefono_id')->references('id')->on('master_combos');
            $table->foreign('tipo_documento_id')->references('id')->on('master_combos');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
