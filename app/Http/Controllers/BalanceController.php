<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Balance;

class BalanceController extends Controller
{
    public function index(Request $request) {
    	$user = Auth::user();
    	$balance = DB::select("SELECT * FROM balance WHERE UserId = " .$user["id"] ." ORDER BY id DESC");
    	$saldo = Balance::obtenerSaldo();

    	return view('balance', ['jumboTitle' => 'Balance Financiero', 'jumboDesc' => 'Acá podés controlar los movimientos de tu cuenta', 'balance' => $balance, 'saldo' => $saldo]);
    }

    public function obtenerSaldoAPI($id) {
    	if ($id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el Id de Usuario!']);       
        } elseif (!is_numeric($id)) {
            return response()->json(['status' => 'error', 'message' => 'El Id de Usuario debe ser un valor numérico!']);
        }
    	
    	return response()->json(['status' => 'ok', 'message' => Balance::obtenerSaldoAPI($id)]);	
    }

    public function obtenerBalanceAPI($id) {
    	if ($id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el Id de Usuario!']);       
        } elseif (!is_numeric($id)) {
            return response()->json(['status' => 'error', 'message' => 'El Id de Usuario debe ser un valor numérico!']);
        }

    	$balance = DB::select("SELECT * FROM balance WHERE UserId = " .$id ." ORDER BY id DESC");

    	return response()->json(['status' => 'ok', 'balance' => $balance]);
    }
}