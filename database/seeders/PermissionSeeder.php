<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            array(
                array(
                    'id' => 1,
                    'name' => 'super admin',
                    'guard_name' => 'web'
                ),
                array(
                    'id' => 2,
                    'name' => 'company',
                    'guard_name' => 'web'
                )
            )
        );


        DB::table('model_has_roles')->insert(
            array(
                'role_id' => '1',
                'model_type' => 'App\Models\User',
                'model_id' => '1',
            )
        );
    }
}
