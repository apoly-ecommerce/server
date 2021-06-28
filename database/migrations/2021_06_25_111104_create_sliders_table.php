<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('title_color', 20)->default('#333E48')->nullable();
            $table->string('sub_title_color', 20)->default('#333E48')->nullable();
            $table->string('description', 255)->nullable();
            $table->string('description_color', 20)->default('#333E48')->nullable();
            $table->string('alt_color', 20)->default('#333E48')->nullable();
            $table->string('text_position', 10)->default('left')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('link')->nullable();
            $table->integer('order')->default(100);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
