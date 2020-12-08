<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',191)->nullable();
            $table->tinyInteger('type')->default(0);
            $table->string('slug',191)->nullable();
            $table->longText('brief_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->default(NULL)->nullable();
            $table->text('meta_description')->default(NULL)->nullable();
            $table->text('images')->nullable();
            $table->integer('viewCount')->default('0');
            $table->integer('commentCount')->default('0');
            $table->string('attr_type')->default(NULL)->nullable();
            $table->text('attr')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('contents');
    }
}
