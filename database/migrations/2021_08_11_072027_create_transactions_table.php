<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(0);

            $table->string('title',255)->nullable();
            $table->integer('price')->default(0)->unsigned();
            $table->integer('count')->default(0)->unsigned();
            $table->text('description')->nullable();
            $table->string('discount_code',10)->nullable();

            $table->morphs('transactionable'); // Adds unsigned INTEGER transaction_id and STRING transaction_type

            $table->integer('status')->default(0); // 0 disable, 1 send to bank ,2 pay successfully, -1 have a problem
            $table->string('message')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}


