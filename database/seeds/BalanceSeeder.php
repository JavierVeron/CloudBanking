<?php

use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balance')->insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => 'Pago de Haberes Febrero/2020', 'Importe' => 65000, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => 1, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('balance')->insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => 'Pago de Haberes Febrero/2020', 'Importe' => 55000, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => 2, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('balance')->insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => 'Pago de Haberes Febrero/2020', 'Importe' => 75000, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => 3, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('balance')->insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => 'Pago de Haberes Febrero/2020', 'Importe' => 60000, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => 4, 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('balance')->insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => 'Pago de Haberes Febrero/2020', 'Importe' => 70000, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => 5, 'created_at' => date("Y-m-d H:i:s")]);
    }
}
