<?php

namespace Database\Seeders;

use App\Models\Widget;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;



class WidgetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Widget::create([
            'file_name' => 'Home',
        ]);
    }
}
