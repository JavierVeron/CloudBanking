<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service')->insert(['Nombre' => 'Claro', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('service')->insert(['Nombre' => 'Movistar', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('service')->insert(['Nombre' => 'Personal', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('service')->insert(['Nombre' => 'Edenor (Luz)', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('service')->insert(['Nombre' => 'Fenosa (Gas Natural)', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('service')->insert(['Nombre' => 'Impuesto Inmobiliario (ARBA)', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('service')->insert(['Nombre' => 'Impuesto Automotor (ARBA)', 'created_at' => date("Y-m-d H:i:s")]);
    }
}
