<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->integer('manufacturer_id')->unsigned()->nullable();
            $table->string('brand')->nullable();
            $table->string('name');
            $table->string('model_number')->nullable();
            $table->string('mpn')->nullable();
            $table->longtext('description')->nullable();
            $table->decimal('min_price', 20, 6)->default(0)->nullable();
            $table->decimal('max_price', 20, 6)->nullable();
            $table->integer('origin_country')->unsigned()->nullable();
            $table->string('slug')->unique();
            $table->text('meta_title')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->bigInteger('sale_count')->nullable();
            $table->boolean('active')->default(1);
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
        Schema::drop('products');
    }
}
