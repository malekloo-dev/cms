<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusWpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('link');
            $table->bigInteger('parent')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable()->default(null);
            $table->integer('menu')->default(1);
            $table->integer('depth')->default(0);
            $table->string('type')->default('internal');
            $table->string('module')->nullable()->default(null);
            $table->integer('module_id')->nullable()->default(null);
            $table->integer('depth_copy')->default(0);
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
        Schema::dropIfExists( 'menus');
    }
}
