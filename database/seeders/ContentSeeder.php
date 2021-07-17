<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert(
            array(
                'title' => 'درباره ما',
                'type' => 1,
                'slug' => 'درباره-ما',
                'parent_id' => 0,
                'attr_type' => 'category',
                'status' => 1,
                'publish_date'=> Carbon::now()
            ),

        );
    }
}
