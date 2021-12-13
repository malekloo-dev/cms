<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentAttributeComboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_attribute_combo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_attribute_id')->unsigned()->default(0);
            $table->string('name',191)->nullable();
            $table->string('value',191)->nullable();

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
        Schema::dropIfExists('content_attribute_combo');
    }

}
