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
        Schema::create('comments', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->string('cards_id')->comment('投稿ID');
            $table->string('content')->comment('本文');

            $table->timestamps();

            $table->index('id');
            $table->index('user_id');
            $table->index('cards_id');


            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('cards_id')
            ->references('id')
            ->on('cards')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
};
