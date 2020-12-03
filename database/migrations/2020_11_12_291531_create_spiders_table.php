<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spiders', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->string('title')->nullable();
            $table->text('attr')->nullable();
            $table->string('price')->nullable();
            $table->string('category')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spiders');
    }
}
