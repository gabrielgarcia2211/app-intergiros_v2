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
            $table->integer('tipo_cuenta_id')->unsigned()->nullable()->after('user_id');
            $table->foreign('tipo_cuenta_id')->references('id')->on('master_combos');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('terceros', function (Blueprint $table) {
            $table->dropForeign(['tipo_cuenta_id']);
            $table->dropColumn('tipo_cuenta_id');
        });
    }
};
