<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->longtext('attr');
            $table->timestamps();
        });

        DB::table('widgets')->insert(
            array(
                'id'=>1,
                'attr' => '{\"news\":{\"parent_id\":\"0\",\"sort\":\"viewCount asc\",\"type\":\"post\",\"count\":\"3\"},\"bestCategory\":{\"parent_id\":\"36\",\"sort\":\"publish_date desc\",\"type\":\"category\",\"count\":\"3\"},\"product\":{\"parent_id\":\"34\",\"sort\":\"publish_date desc\",\"type\":\"product\",\"count\":\"3\"}}',
               )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widgets');
    }
}
