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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->integer('total_price')->default(0)->unsigned();

            // $table->morphs('orderable'); // Adds unsigned INTEGER order_id and STRING order_type

            $table->integer('status')->default(0); // 0 not pay, 1 send to bank ,2 pay successfully,3 prepairing,4 ready to send, -1 have a problem
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
};
