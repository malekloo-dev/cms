<?php

use Database\Seeders\ContentSeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\WebsiteSettingSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\WidgetsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersSeeder::class);
        $this->call(PermissionSeeder::class);

        $this->call(WidgetsSeeder::class);
        $this->call(WebsiteSettingSeeder::class);

        $this->call(ContentSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
