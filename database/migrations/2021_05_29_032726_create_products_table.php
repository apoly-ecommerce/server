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
            $table->longText('detail_information')->nullable();
            $table->longtext('description')->nullable();
            $table->double('promotional_price', 20, 6);
            $table->double('original_price', 20, 6);
            $table->boolean('requires_shipping')->default(1)->nullable();
            $table->string('slug')->unique();
            $table->text('meta_title')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->bigInteger('sale_count')->nullable();
            $table->boolean('active')->default(1);

            $table->string('warranty_period')->nullable();
            $table->string('warranty_form')->nullable();
            $table->string('warranty_place')->nullable();

            $table->string('percent_refund')->nullable();
            $table->string('return_time')->nullable();
            $table->boolean('allow_inspection')->default(false)->nullable();

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
