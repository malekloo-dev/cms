<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebsiteSetting::insert([
            ['variable'=>'meta_title','value'=>''],
            ['variable'=>'meta_description','value'=>''],
            ['variable'=>'meta_keywords','value'=>''],
            ['variable'=>'url','value'=>''],
            ['variable'=>'og:type','value'=>''],
            ['variable'=>'phone','value'=>''],
        ]);
    }
}
