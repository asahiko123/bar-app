<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->string('menu')->comment('名前')->after('user_id');
            $table->integer('price')->comment('価格')->unsigned()->after('menu');
            $table->string('bar')->comment('店舗名')->after('price');
            $table->tinyInteger('easyToDrink')->comment('飲みやすさ')->unsigned();
            $table->tinyInteger('sweet')->comment('甘さ')->unsigned();
            $table->tinyInteger('dry')->comment('辛さ')->unsigned();
            $table->tinyInteger('fresh')->comment('爽やかさ')->unsigned();
            $table->tinyInteger('sharp')->comment('キレのよさ')->unsigned();
            $table->tinyInteger('mellow')->comment('芳醇さ')->unsigned();
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('menu');
            $table->dropColumn('price');
            $table->dropColumn('bar');
            $table->dropColumn('easyToDrink');
            $table->dropColumn('sweet');
            $table->dropColumn('dry');
            $table->dropColumn('fresh');
            $table->dropColumn('sharp');
            $table->dropColumn('mellow');
        });
    }
};
