<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_recipients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('recipient_id')->unsigned();
            $table->bigInteger('recipient_group_id')->unsigned();
            $table->bigInteger('message_id')->unsigned();
            $table->integer('is_read')->default(0);

            $table->timestamps();

            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_group_id')->references('id')->on('user_group')->onDelete('cascade');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('message_recipients');
    }
}
