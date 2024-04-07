<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('terceros', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_formulario_id')->nullable()->after('user_id');
            $table->foreign('tipo_formulario_id')->references('id')->on('tipo_formulario');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('terceros', function (Blueprint $table) {
            $table->dropForeign(['tipo_formulario_id']);
            $table->dropColumn('tipo_formulario_id');
        });
    }
};
