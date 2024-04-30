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
        Schema::create('referencias_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('pais')->nullable();
            $table->string('banco')->nullable();
            $table->string('titular')->nullable();
            $table->string('tipo')->nullable();
            $table->string('numero')->nullable();
            $table->boolean('especial')->nullable();
            $table->string('otros')->nullable();
            $table->foreignId('tipo_moneda_id')->nullable();
            $table->foreign('tipo_moneda_id')->references('id')->on('tipo_moneda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referencias_bancarias');
    }
};
