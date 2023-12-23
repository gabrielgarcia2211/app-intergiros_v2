<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipo_formulario_id')->unsigned();
            $table->bigInteger('tipo_moneda_id')->unsigned();
            $table->bigInteger('tercero_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('estado_id')->unsigned()->nullable();
            $table->foreign('tipo_formulario_id')->references('id')->on('tipo_formulario');
            $table->foreign('tipo_moneda_id')->references('id')->on('tipo_moneda');
            $table->foreign('tercero_id')->references('id')->on('terceros');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estado_id')->references('id')->on('master_combos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
