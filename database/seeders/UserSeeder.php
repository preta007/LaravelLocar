<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'name' => 'Sistema',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234'),
                'theme' => 'default',

            ],
            [
                'name' => 'Imobiliaria',
                'email' => 'imobiliaria@teste.com',
                'password' => bcrypt('1234'),
                'theme' => 'default',
            ],
        ];
        DB::table('users')->insert($users);
    }
}
