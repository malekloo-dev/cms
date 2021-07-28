<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
                array(
                    'name' => 'admin',
                    'email' => 'm@m.m',
                    'mobile' => '123',
                    'pass' => '12345678',
                    'password' => Hash::make('12345678') //'$2y$10$CXDC/iH/ugEG4zCZdfgZLuNUB3rZ.opJoLH.dbEL7mPurnKMtHlTS'
                )
            );
    }
}
