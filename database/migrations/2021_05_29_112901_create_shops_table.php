<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('owner_id')->unsigned();
            $table->text('name')->nullable();
            $table->text('legal_name')->nullable();
            $table->string('slug', 200)->unique();
            $table->string('email')->unique();
            $table->longtext('description')->nullable();
            $table->string('external_url')->nullable();

            $table->boolean('active')->nullable()->default(0);
            $table->boolean('is_subscribed')->nullable()->default(0);
            $table->boolean('phone_verified')->nullable()->default(Null);
            $table->boolean('address_verified')->nullable()->default(Null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shops');
    }

}
