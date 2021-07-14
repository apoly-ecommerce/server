<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('created_by')->unsigned();
            $table->integer('shop_id')->unsigned()->nullable();
            $table->string('name');
            $table->integer('status')->default(1);
            $table->longtext('description')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('chat_room_user', function (Blueprint $table) {
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();

            $table->foreign('room_id')->references('id')->on('chat_rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chat_room_user');
        Schema::drop('chat_rooms');
    }
}
