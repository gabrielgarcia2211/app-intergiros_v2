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
        Schema::create('depositantes', function (Blueprint $table) {
            $table->id();
            $table->string("alias");
            $table->string("nombre");
            $table->integer("documento");
            $table->string("correo");
            $table->string("celular");
            $table->unsignedInteger('tipo_documento_id')->nullable();
            $table->unsignedInteger('pais_id')->nullable();
            $table->unsignedInteger('pais_telefono_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento_combo');
            $table->foreign('pais_telefono_id')->references('id')->on('pais_telefono_combo');
            $table->foreign('pais_id')->references('id')->on('pais_combo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depositantes');
    }
};
