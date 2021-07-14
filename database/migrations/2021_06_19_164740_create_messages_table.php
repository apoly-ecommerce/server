<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('chat_rooms', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->bigInteger('created_by')->unsigned();
        //     $table->integer('shop_id')->unsigned()->nullable();
        //     $table->string('name');
        //     $table->integer('status')->default(1);
        //     $table->longtext('description')->nullable();
        //     $table->timestamps();

        //     $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        // });

        // Schema::create('chat_room_user', function (Blueprint $table) {
        //     $table->bigInteger('room_id')->unsigned()->index();
        //     $table->bigInteger('user_id')->unsigned()->index();

        //     $table->foreign('room_id')->references('id')->on('chat_rooms')->onDelete('cascade');
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });


        // Schema::create('room_messages', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->bigInteger('room_id')->unsigned();
        //     $table->bigInteger('user_id')->unsigned();
        //     $table->longtext('message')->nullable();
        //     $table->integer('status')->default(1);
        //     $table->timestamps();

        //     $table->foreign('room_id')->references('id')->on('chat_rooms')->onDelete('cascade');
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });


    //     Schema::create('user_messages', function (Blueprint $table) {
    //       $table->bigIncrements('id');
    //       $table->bigInteger('source_id')->unsigned();
    //       $table->bigInteger('target_id')->unsigned();
    //       $table->longtext('message')->nullable();
    //       $table->integer('status')->default(1);
    //       $table->timestamps();

    //       $table->foreign('source_id')->references('id')->on('users')->onDelete('cascade');
    //       $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');
    //   });

    //     Schema::create('customer_messages', function (Blueprint $table) {
    //         $table->bigIncrements('id');
    //         $table->bigInteger('user_id')->unsigned();
    //         $table->bigInteger('customer_id')->unsigned();
    //         $table->longtext('message')->nullable();
    //         $table->integer('status')->default(1);
    //         $table->timestamps();

    //         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //         $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
    //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('customer_messages');
        // Schema::dropIfExists('user_messages');
        // Schema::dropIfExists('group_messages');
        // Schema::dropIfExists('chat_room_user');
        // Schema::dropIfExists('user_groups');
    }
}