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
        Schema::create('terceros', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->string('nombre');
            $table->integer('documento');
            $table->string('banco')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('pago_movil')->nullable();
            $table->string('correo')->nullable();
            $table->string('celular')->nullable();
            $table->integer('pais_id')->unsigned()->nullable();
            $table->integer('pais_telefono_id')->unsigned()->nullable();
            $table->integer('tipo_documento_id')->unsigned()->nullable();
            $table->integer('tipo_tercero_id')->unsigned()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('path_documento')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tipo_documento_id')->references('id')->on('master_combos');
            $table->foreign('tipo_tercero_id')->references('id')->on('master_combos');
            $table->foreign('pais_id')->references('id')->on('master_combos');
            $table->foreign('pais_telefono_id')->references('id')->on('master_combos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terceros');
    }
};
