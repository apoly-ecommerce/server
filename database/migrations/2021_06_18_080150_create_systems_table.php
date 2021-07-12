<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('install_version')->nullable();
            $table->boolean('maintenance_mode')->nullable();
            //Mandatory Settings
            $table->string('name')->default('Marketplace');
            $table->text('slogan')->nullable();
            $table->text('legal_name')->nullable();
            $table->string('email')->nullable();

            // Support
            $table->string('support_phone')->nullable();
            $table->string('support_phone_toll_free')->nullable();
            $table->string('support_email');
            $table->string('default_sender_email_address')->nullable();
            $table->string('default_email_sender_name')->nullable();

            // Social Links
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();

            // Address
            $table->integer('address_default_country')->nullable();
            $table->integer('address_default_state')->nullable();
            $table->boolean('show_address_title')->nullable();
            $table->boolean('address_show_country')->nullable();
            $table->boolean('address_show_map')->nullable();

            // Notification Settings
            $table->boolean('notify_when_vendor_registered')->nullable()->default(true);
            $table->boolean('notify_new_message')->nullable();
            $table->boolean('enable_chat')->nullable()->default(true);

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
        Schema::drop('systems');
    }
}
