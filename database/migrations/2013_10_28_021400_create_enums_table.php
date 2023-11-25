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
    public function up()
    {
        Schema::create('pais_combo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
        });

        DB::table('pais_combo')->insert([
            ['nombre' => 'Colombia'],
            ['nombre' => 'Venezuela'],
            ['nombre' => 'Perú'],
        ]);

        Schema::create('pais_telefono_combo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
        });

        DB::table('pais_telefono_combo')->insert([
            ['codigo' => '+57'],
            ['codigo' => '+58'],
            ['codigo' => '+51'],
        ]);

        Schema::create('redes_combo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
        });

        DB::table('redes_combo')->insert([
            ['nombre' => 'Facebook'],
            ['nombre' => 'Instagram'],
        ]);

        Schema::create('tipo_documento_combo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
        });

        DB::table('tipo_documento_combo')->insert([
            ['codigo' => 'T'],
            ['codigo' => 'CC'],
            ['codigo' => 'A'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('pais');
        Schema::dropIfExists('pais_telefono');
    }
};
