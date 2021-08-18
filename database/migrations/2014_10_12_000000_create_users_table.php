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

        // DB::table('users')->insert(
        //     array(
        //         'name' => 'admin',
        //         'email' => 'm@m.m',
        //         'password' => '$2y$10$CXDC/iH/ugEG4zCZdfgZLuNUB3rZ.opJoLH.dbEL7mPurnKMtHlTS'
        //     )
        // );
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
