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
            $table->bigInteger('depositante_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('estado_id')->unsigned()->nullable();
            $table->string('monto_a_pagar');
            $table->string('monto_a_recibir');
            $table->string('revisiones');
            $table->string('imagen_comprobante', 255)->nullable();
            $table->tinyInteger('notificacion')->default(1);
            $table->foreign('tipo_formulario_id')->references('id')->on('tipo_formulario');
            $table->foreign('tipo_moneda_id')->references('id')->on('tipo_moneda');
            $table->foreign('depositante_id')->references('id')->on('terceros');
            $table->foreign('beneficiario_id')->references('id')->on('terceros');
            $table->foreign('producto_id')->references('id')->on('productos');
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
