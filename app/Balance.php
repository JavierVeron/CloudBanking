<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Balance extends Model
{
    protected $table = "balance";

    protected $fillable = ["Fecha", "Desc", "Importe"];

    static function obtenerSaldo() {
        $user = Auth::user();
    	$saldo = DB::select("SELECT SUM(Importe) AS peso, SUM(Importe_Dolar) AS dolar, SUM(Importe_Euro) AS euro FROM balance WHERE UserId = " .$user["id"]);

    	if ($saldo[0]->peso == "") {
    		$saldo = 0;
    	} else {
    		$saldo = $saldo[0];
    	}

    	return $saldo;
    }

    static function obtenerSaldoAPI($id) {
        $user = Auth::user();
        $saldo = DB::select("SELECT SUM(Importe) AS peso, SUM(Importe_Dolar) AS dolar, SUM(Importe_Euro) AS euro FROM balance WHERE UserId = " .$id);

        if ($saldo[0]->peso == "") {
            $saldo = 0;
        } else {
            $saldo = $saldo[0];
        }

        return $saldo;
    }
}
