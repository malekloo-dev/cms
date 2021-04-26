<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id')->default(0);
            $table->unsignedBigInteger('content_id')->default(0);
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('contents')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('content_id')->references('id')->on('contents')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents_category');
    }
}
