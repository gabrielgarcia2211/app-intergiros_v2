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
            $table->string('email')->unique();
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedInteger('pais_id')->nullable();
            $table->unsignedInteger('pais_telefono_id')->nullable();
            $table->unsignedInteger('tipo_documento_id')->nullable();
            $table->foreign('pais_telefono_id')->references('id')->on('pais_telefono_combo');
            $table->foreign('pais_id')->references('id')->on('pais_combo');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento_combo');
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
