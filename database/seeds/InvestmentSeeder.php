<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('investment')->insert(['Empresa' => 'Dólar', 'Acciones' => '100000', 'Valor' => '60.16', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('investment')->insert(['Empresa' => 'Euro', 'Acciones' => '100000', 'Valor' => '66.38', 'created_at' => date("Y-m-d H:i:s")]);
    }
}
