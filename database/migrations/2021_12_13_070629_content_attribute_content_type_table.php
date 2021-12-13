<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentAttributeContentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_attribute_content_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_type_id')->unsigned()->default(0);
            $table->bigInteger('content_attribute_id')->unsigned()->default(0);

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
        Schema::dropIfExists('content_attribute_content_type');
    }
}
