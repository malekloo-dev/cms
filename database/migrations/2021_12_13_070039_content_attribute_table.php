<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('field_name',191)->nullable();
            $table->string('label',191)->nullable();
            $table->string('element_type',191)->nullable()->default('text');
            $table->string('element_input_type',191)->nullable()->default('text')->comment('int,phone,text,');
            $table->integer('required')->nullable()->default(0);
            $table->integer('filter')->nullable()->default(0);

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
        Schema::dropIfExists('content_attribute');

    }
}
