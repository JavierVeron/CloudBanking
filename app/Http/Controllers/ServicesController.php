<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Service;
use App\Balance;

class ServicesController extends Controller
{
    public function index(Request $request) {
    	$servicios = Service::orderBy('Nombre', 'ASC')->get();
        $saldo = Balance::obtenerSaldo();

    	return view('pago-de-servicios', ['jumboTitle' => 'Pago de Servicios', 'jumboDesc' => 'Paga todo lo que necesites desde la comodidad de tu casa', 'servicios' => $servicios, 'saldo' => $saldo]);
    }

    public function pagoDeServicios(Request $request) {
    	if ($request->importe == "") {
            return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>Debe completar el Campo Importe!</div>"]);       
        } elseif (!is_numeric($request->importe)) {
            return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>El campo Importe debe ser un valor numérico!</div>"]);
        }

        $saldo = Balance::obtenerSaldo();

    	if ($saldo->peso >= $request->importe) {
            $user = Auth::user();
    		Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->nombre, 'Importe' => -$request->importe, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => $user["id"], 'created_at' => date("Y-m-d H:i:s")]);

    		return response()->json(["message" => "<div class='alert-success' role='alert' style='color:#333333; text-align:center; padding:10px;'>El Pago del Servicio se ha realizado con éxito!</div>"]);
        }

        return response()->json(["message" => "<div class='alert-danger' role='alert' style='color:#333333; text-align:center; padding:10px;'>No tienes fondos suficientes para poder realizar el Pago del Servicio!</div>"]);
    }

    public function obtenerServiciosAPI() {
        $servicios = Service::orderBy('Nombre', 'ASC')->get();

        return response()->json(['status' => 'ok', 'servicios' => $servicios]);
    }

    public function pagoDeServiciosAPI(Request $request) {
        if ($request->nombre == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo Nombre!']);       
        }

        if ($request->importe == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo Importe!']);       
        } elseif (!is_numeric($request->importe)) {
            return response()->json(['status' => 'error', 'message' => 'El campo Importe debe ser un valor numérico!']);
        }

        if ($request->id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe completar el Campo Id!']);       
        } elseif (!is_numeric($request->id)) {
            return response()->json(['status' => 'error', 'message' => 'El campo UserId debe ser un valor numérico!']);
        }

        $saldo = Balance::obtenerSaldoAPI($request->id);
        $servicios = Service::orderBy('Nombre', 'ASC')->get();

        if ($saldo->peso >= $request->importe) {
            Balance::insert(['Fecha' => date("Y-m-d H:i:s"), 'Desc' => $request->nombre, 'Importe' => -$request->importe, 'Importe_Dolar' => 0, 'Importe_Euro' => 0, 'UserId' => $request->id, 'created_at' => date("Y-m-d H:i:s")]);

            return response()->json(['status' => 'ok', 'message' => 'El Pago del Servicio se ha realizado con éxito!']);
        }

        return response()->json(['status' => 'error', 'message' => 'No tienes fondos suficientes para poder realizar el Pago del Servicio!']);
    }
}