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
            $table->dropColumn('banco');
            $table->integer('banco_id')->unsigned()->nullable()->after('user_id');
            $table->foreign('banco_id')->references('id')->on('master_combos');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('terceros', function (Blueprint $table) {
            $table->dropForeign(['banco_id']);
            $table->dropColumn('banco_id');
        });
    }
};
