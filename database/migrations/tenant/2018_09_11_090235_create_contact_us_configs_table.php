<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('fields');
            $table->binary('config');
            $table->binary('additional_email')->nullable;
            $table->string('subject',255);
            $table->text('mail_body');
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
        Schema::dropIfExists('contact_us_configs');
    }
}
