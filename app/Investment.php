<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Investment extends Model
{
    protected $table = "investment";

    static function obtenerDolarDisponible() {
    	$saldo = DB::select("SELECT acciones FROM investment WHERE empresa LIKE 'Dólar'");

    	return $saldo[0]->acciones;
    }

    static function obtenerEuroDisponible() {
    	$saldo = DB::select("SELECT acciones FROM investment WHERE empresa LIKE 'Euro'");

    	return $saldo[0]->acciones;
    }

    static function obtenerValorAccion($moneda) {
    	$saldo = DB::select("SELECT valor FROM investment WHERE empresa LIKE '" .$moneda. "'");

    	return $saldo[0]->valor;
    }
}
