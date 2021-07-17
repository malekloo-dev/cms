<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert(
            array(
                array(
                    'id' => 1,
                    'label' => 'خانه',
                    'link' => '/',
                    'parent' => 0,
                    'sort' => 1,
                    'menu' => 1,
                    'depth' => 0,
                    'type' => 'external',
                    'module' => null,
                    'module_id' => null,
                ),
                array(
                    'id' => 2,
                    'label' => 'درباره ما',
                    'link' => 'درباره-ما',
                    'parent' => 0,
                    'sort' => 2,
                    'menu' => 1,
                    'depth' => 0,
                    'type' => 'internal',
                    'module' => 'category',
                    'module_id' => '1',
                ),
            )
        );
    }
}
