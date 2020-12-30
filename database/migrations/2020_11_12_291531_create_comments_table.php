<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->unsignedBigInteger('content_id')->default(0);
            $table->string('name')->nullable();
            $table->string('comment')->nullable();
            $table->string('rate')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('comments');
    }
}
