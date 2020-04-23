<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            $table->string('uniq');
            $table->string('operator_id');
            $table->string('message')->nullable();
            $table->string('sender');
            $table->integer('question_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('seen')->nullable();
            $table->timestamp('date')->useCurrent();
            //$table->collation = 'utfmb4';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
