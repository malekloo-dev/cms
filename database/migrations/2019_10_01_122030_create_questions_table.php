<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bot_id');
            $table->integer('element_id');
            $table->string('message')->nullable();
            $table->string('type');
            $table->longText('params')->nullable();
            $table->integer('priority')->nullable();
            $table->timestamp('date')->useCurrent();

        });

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 1,
                'message' => "Hello welcome to our website",
                'type' => 'message',
                'params' => '{"next":"3"}',
                'priority' => 0
            )
        );

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 3,
                'message' => "Please tell us your email:",
                'type' => 'question',
                'params' => '{"next":"4","required":1,"validation":"email"}',
                'priority' => 1
            )
        );

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 4,
                'message' => "We will communicate with you by your email",
                'type' => 'message',
                'params' => '{"next":"2"}',
                'priority' => 2
            )
        );

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 2,
                'message' => "What do you want to do?",
                'type' => 'multiple-choice',
                'params' => '{"list":[{"next":"5","label":"Set an appointment","value":"Set an appointment"},{"next":"end","label":"Get My Location","value":"Get My Location"},{"next":"end","label":"Nothing","value":"Nothing"}]}',
                'priority' => 3
            )
        );

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 5,
                'message' => "Book an appointment",
                'type' => '4smile_api',
                'params' => '{"next":"6"}',
                'priority' => 4
            )
        );

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 6,
                'message' => "Book an appointment",
                'type' => '4smile_api',
                'params' => '{"next":"6"}',
                'priority' => 5
            )
        );

        DB::table('questions')->insert(
            array(
                'bot_id' => 1,
                'element_id' => 7,
                'message' => "Please choose a date for your appointment:",
                'type' => 'calendar',
                'params' => '{"next":"end", "days": ["2019-10-17","2019-10-18","2019-10-19","2019-10-20","2019-10-21","2019-10-22","2019-10-23"]}',
                'priority' => 6
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
        Schema::dropIfExists('questions');
    }
}
