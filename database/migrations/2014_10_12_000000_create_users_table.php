<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('mobile')->unique();
            $table->string('email',151)->nullable();
            $table->integer('balance')->default(0)->unsigned();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('pass');
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('date')->useCurrent();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
