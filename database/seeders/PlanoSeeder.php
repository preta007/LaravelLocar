<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $planos = [
            [
                'nome' => 'Plano Standard',
                'percentual' => 12,
                'limite' => 5000,
                'ativo' => 1,

            ],
            [
                'nome' => 'Plano Gold',
                'percentual' => 10,
                'limite' => 5000,
                'ativo' => 1,
            ],
            [
                'nome' => 'Plano Platinum',
                'percentual' => 8,
                'limite' => 5000,
                'ativo' => 1,
            ],
            [
                'nome' => 'Plano Black Infinity',
                'percentual' => 10,
                'limite' => 90000,
                'ativo' => 1,
            ],
        ];
        DB::table('planos')->insert($planos);
    }
}
