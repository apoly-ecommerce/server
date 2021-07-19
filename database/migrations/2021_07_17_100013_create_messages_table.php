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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('creator_id')->unsigned();
            $table->longtext('message_body');
            $table->bigInteger('parent_message_id')->unsigned()->nullable();
            // $table->timestamp('expiry_date', 0);
            // $table->integer('is_reminder')->default(0);
            // $table->bigInteger('reminder_frequency_id', 10)->default(0)->nullable();
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_message_id')->references('id')->on('messages')->onDelete('cascade');

            // $table->foreign('reminder_frequency_id')->references('id')->on('reminder_frequencies')->onDelete('cascade');
        });

        // Schema::create('message_recipients', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->bigInteger('recipient_id');
        //     $table->bigInteger('recipient_group_id');
        //     $table->bigInteger('message_id');
        //     $table->integer('is_read')->default(0);
        //     $table->timestamps();

        //     $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('recipient_group_id')->references('id')->on('user_group')->onDelete('cascade');
        //     $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('message_recipients');
        Schema::drop('messages');
    }
}