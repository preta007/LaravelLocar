<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxas = [
            [
                'nome' => 'Setup',
                'valor' => 250.00,
                'comissao' => 175.00,
                'parcelas' => 3,
                'codigo_vindi' => 523606,
                'codigo_plano_vindi' => 191560,
                'ativo' => 1,

            ],
            [
                'nome' => 'Setup',
                'valor' => 120.00,
                'comissao' => 84.00,
                'parcelas' => 3,
                'codigo_vindi' => 526190,
                'codigo_plano_vindi' => 191559,
                'ativo' => 1,

            ],
            [
                'nome' => 'Isenta',
                'valor' => 0.00,
                'comissao' => 0.00,
                'parcelas' => 0,
                'codigo_vindi' => 0,
                'codigo_plano_vindi' => 0,
                'ativo' => 1,

            ],
           
        ];
        DB::table('taxas')->insert($taxas);
    }
}
