<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentAttributeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_attribute_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_id')->unsigned()->default(0);
            $table->bigInteger('content_type_id')->unsigned()->default(0);
            $table->bigInteger('content_attribute_id')->unsigned()->default(0);
            $table->bigInteger('company_id')->unsigned()->default(0);

            $table->string('label',191)->nullable();
            $table->string('field_name',191)->nullable();
            $table->string('type',191)->nullable()->comment('combo,text,');
            $table->string('value',191)->nullable();

            $table->json('json')->nullable();

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
        Schema::dropIfExists('content_attribute_value');
    }
}
