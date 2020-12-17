<?php

use App\WebsiteSetting as AppWebsiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WebsiteSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_setting', function (Blueprint $table) {
            $table->id();
            $table->string('variable',100);
            $table->string('value',250);
        });

        AppWebsiteSetting::createMany([
            ['variable'=>'meta_title','value'=>''],
            ['variable'=>'meta_description','value'=>''],
            ['variable'=>'meta_keywords','value'=>''],
            ['variable'=>'url','value'=>''],
            ['variable'=>'og:type','value'=>''],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('website_setting');
    }
}
