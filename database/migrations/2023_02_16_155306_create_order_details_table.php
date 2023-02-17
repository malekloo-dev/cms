<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->default(0);
            $table->string('title',255)->nullable();
            $table->integer('price')->default(0)->unsigned();
            $table->integer('count')->default(0)->unsigned();
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')
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
        Schema::dropIfExists('order_details');
    }
};
