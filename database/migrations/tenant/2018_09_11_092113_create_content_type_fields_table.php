<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTypeFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_type_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('machine_name');
            $table->string('field_label');
            $table->string('field_type');
            $table->string('widget_type')->nullable();
            $table->string('field_length')->nullable();
            $table->boolean('primary')->nullable();
            $table->integer('content_type_id');
            $table->string('content_type_machine_name');
            $table->text('default_value')->nullable();
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
        Schema::dropIfExists('content_type_fields');
    }
}
