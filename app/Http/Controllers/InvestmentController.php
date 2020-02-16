<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Investment;
use App\Balance;

class InvestmentController extends Controller
{
    public function index(Request $request) {
    	$inversiones = Investment::orderBy('Id', 'ASC')->get();
        $saldo = Balance::obtenerSaldo();

    	return view('inversiones', ['jumboTitle' => 'Inversiones', 'jumboDesc' => 'Duplicá tus ahorros en el Mercado Financiero', 'inversiones' => $inversiones, 'saldo' => $saldo]);
    }

    public function comprarAcciones(Request $request) {
        $saldo = Balance::obtenerSaldo();
        $importe = $request->acciones * Investment::obtenerValorAccion($request->moneda);
        $dolar_disponible = Investment::obtenerDolarDisponible();
        $euro_disponible = Investment::obtenerEuroDisponible();

        if ($saldo->peso >= $importe) {
            if ($request->moneda == "Dólar") {            
                if ($dolar_disponible >= $request->acciones) {
                    $user = Auth::user();
                    $acciones = $dolar_disponible - $request->acciones;
                    DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                    Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => -$importe, 'Importe_Dolar' => $request->acciones, 'Importe_Euro' => 0, 'UserId' => $user["id"], 'created_at' => date("Y-m-d H:i:s")]);

                    return response()->json(["message" => "<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>La Compra de Dólares se ha realizado con éxito!</div>"]);
                } else {
                    return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>No tienes suficientes Acciones para Comprar!</div>"]);
                }
            } else {
                if ($euro_disponible >= $request->acciones) {
                    $user = Auth::user();
                    $acciones = $euro_disponible - $request->acciones;
                    DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                    Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => -$importe, 'Importe_Dolar' => 0, 'Importe_Euro' => $request->acciones, 'UserId' => $user["id"], 'created_at' => date("Y-m-d H:i:s")]);

                    return response()->json(["message" => "<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>La Compra de Euros se ha realizado con éxito!</div>"]);
                } else {
                    return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>No tienes suficientes Acciones para Comprar!</div>"]);
                }
            }
        } else {
           return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>No tienes saldo suficiente para Comprar!</div>"]);  
        }
    }

    public function venderAcciones(Request $request) {
        $saldo = Balance::obtenerSaldo();
        $importe = $request->acciones * Investment::obtenerValorAccion($request->moneda);
        $dolar_disponible = Investment::obtenerDolarDisponible();
        $euro_disponible = Investment::obtenerEuroDisponible();

        if ($request->moneda == "Dólar") {
            if ($request->acciones <= $saldo->dolar) {
                $user = Auth::user();
                $acciones = $dolar_disponible + $request->acciones;
                DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => $importe, 'Importe_Dolar' => -$request->acciones, 'Importe_Euro' => 0, 'UserId' => $user["id"], 'created_at' => date("Y-m-d H:i:s")]);

                return response()->json(["message" => "<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>La Venta de Dólares se ha realizado con éxito!</div>"]);
            } else {
                return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>No tienes suficientes Acciones para Vender!</div>"]);
            }
        } else {
            if ($request->acciones <= $saldo->euro) {
                $user = Auth::user();
                $acciones = $euro_disponible + $request->acciones;
                DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => $importe, 'Importe_Dolar' => 0, 'Importe_Euro' => -$request->acciones, 'UserId' => $user["id"], 'created_at' => date("Y-m-d H:i:s")]);

                return response()->json(["message" => "<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>La Venta de Euros se ha realizado con éxito!</div>"]);
            } else {
                return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>No tienes suficientes Acciones para Vender!</div>"]);
            }
        }
    }

    public function comprarAccionesAPI(Request $request) {
        $request->operacion = 'Comprar';

        if ($request->moneda == 1) {
            $request->moneda = 'Dólar';
        } elseif ($request->moneda == 2) {
            $request->moneda = 'Euro';
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se reconoce el Tipo de Moneda especificado!']);       
        }

        if ($request->acciones == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo Acciones!']);       
        } elseif (!is_numeric($request->acciones)) {
            return response()->json(['status' => 'error', 'message' => 'El campo Acciones debe ser un valor numérico!']);
        }

        if ($request->id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo UserId!']);       
        } elseif (!is_numeric($request->id)) {
            return response()->json(['status' => 'error', 'message' => 'El campo UserId debe ser un valor numérico!']);
        }

        $saldo = Balance::obtenerSaldoAPI($request->id);
        $importe = $request->acciones * Investment::obtenerValorAccion($request->moneda);
        $dolar_disponible = Investment::obtenerDolarDisponible();
        $euro_disponible = Investment::obtenerEuroDisponible();

        if ($saldo->peso >= $importe) {
            if ($request->moneda == "Dólar") {            
                if ($dolar_disponible >= $request->acciones) {
                    $acciones = $dolar_disponible - $request->acciones;
                    DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                    Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => -$importe, 'Importe_Dolar' => $request->acciones, 'Importe_Euro' => 0, 'UserId' => $request->id, 'created_at' => date("Y-m-d H:i:s")]);

                    return response()->json(['status' => 'ok', 'message' => 'La Compra de Dólares se ha realizado con éxito!']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'No tienes suficientes Acciones para Comprar!']);
                }
            } else {
                if ($euro_disponible >= $request->acciones) {
                    $acciones = $euro_disponible - $request->acciones;
                    DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                    Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => -$importe, 'Importe_Dolar' => 0, 'Importe_Euro' => $request->acciones, 'UserId' => $request->id, 'created_at' => date("Y-m-d H:i:s")]);

                    return response()->json(['status' => 'ok', 'message' => 'La Compra de Euros se ha realizado con éxito!']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'No tienes suficientes Acciones para Comprar!']);
                }
            }
        } else {
           return response()->json(['status' => 'error', 'message' => 'No tienes saldo suficiente para Comprar!']);  
        }
    }

    public function venderAccionesAPI(Request $request) {
        $request->operacion = 'Vender';

        if ($request->moneda == 1) {
            $request->moneda = 'Dólar';
        } elseif ($request->moneda == 2) {
            $request->moneda = 'Euro';
        } else {
            return response()->json(['status' => 'error', 'message' => 'No se reconoce el Tipo de Moneda especificado!']);       
        }

        if ($request->acciones == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo Acciones!']);       
        } elseif (!is_numeric($request->acciones)) {
            return response()->json(['status' => 'error', 'message' => 'El campo Acciones debe ser un valor numérico!']);
        }

        if ($request->id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo UserId!']);       
        } elseif (!is_numeric($request->id)) {
            return response()->json(['status' => 'error', 'message' => 'El campo UserId debe ser un valor numérico!']);
        }

        $saldo = Balance::obtenerSaldoAPI($request->id);
        $importe = $request->acciones * Investment::obtenerValorAccion($request->moneda);
        $dolar_disponible = Investment::obtenerDolarDisponible();
        $euro_disponible = Investment::obtenerEuroDisponible();

        if ($request->moneda == "Dólar") {
            if ($request->acciones <= $saldo->dolar) {
                $acciones = $dolar_disponible + $request->acciones;
                DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => $importe, 'Importe_Dolar' => -$request->acciones, 'Importe_Euro' => 0, 'UserId' => $request->id, 'created_at' => date("Y-m-d H:i:s")]);

                return response()->json(['status' => 'ok', 'message' => 'La Venta de Dólares se ha realizado con éxito!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'No tienes suficientes Acciones para Vender!']);
            }
        } else {
            if ($request->acciones <= $saldo->euro) {
                $acciones = $euro_disponible + $request->acciones;
                DB::update("UPDATE investment SET acciones = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE empresa = ?", [$acciones, $request->moneda]);
                Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->operacion .": " .$request->moneda, 'Importe' => $importe, 'Importe_Dolar' => 0, 'Importe_Euro' => -$request->acciones, 'UserId' => $request->id, 'created_at' => date("Y-m-d H:i:s")]);

                return response()->json(['status' => 'ok', 'message' => 'La Venta de Euros se ha realizado con éxito!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'No tienes suficientes Acciones para Vender!']);
            }
        }
    }     
}