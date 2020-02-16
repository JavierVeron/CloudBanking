<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('user', ['jumboTitle' => 'Datos del Usuario', 'jumboDesc' => 'Aquí podrás modificar tu Nombre, Email y/o Contraseña', 'usuario' => $user]);
    }

    public function crearUsuarioAPI(Request $request) {
    	if ($request->nombre == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el campo Nombre!']);       
        }

        if ($request->email == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el campo Email!']);       
        }

        if ($request->password == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el campo Password!']);       
        }

        $usuario = DB::insert("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, '" .date("Y-m-d H:i:s") ."')", [$request->nombre, $request->email, bcrypt($request->password)]);

        if ($usuario) {
        	return response()->json(['status' => 'ok', 'message' => 'El usuario se ha creado con éxito!']);
        } else {
        	return response()->json(['status' => 'error', 'message' => 'No se pudo crear el Usuario especificado!']);
        }
    }

    public function obtenerUsuarioAPI($id) {
    	if ($id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el Id de Usuario!']);       
        } elseif (!is_numeric($id)) {
            return response()->json(['status' => 'error', 'message' => 'El Id de Usuario debe ser un valor numérico!']);
        }

    	$usuario = DB::select("SELECT * FROM users WHERE id = " .$id);

    	return response()->json(['status' => 'ok', 'usuario' => $usuario]);
    }

    public function actualizarUsuarioAPI(Request $request) {
    	if ($request->nombre == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el campo Nombre!']);       
        }

        if ($request->email == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el campo Email!']);       
        }

    	if ($request->id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el Id de Usuario!']);       
        } elseif (!is_numeric($request->id)) {
            return response()->json(['status' => 'error', 'message' => 'El Id de Usuario debe ser un valor numérico!']);
        }

        if (isset($request->password)) {
        	$usuario = DB::update("UPDATE users SET name = ?, email = ?, password = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE id = ?", [$request->nombre, $request->email, bcrypt($request->password), $request->id]);
        } else {
        	$usuario = DB::update("UPDATE users SET name = ?, email = ?, updated_at = '" .date("Y-m-d H:i:s") ."' WHERE id = ?", [$request->nombre, $request->email, $request->id]);
        }

        if ($usuario) {
        	return response()->json(['status' => 'ok', 'message' => 'El usuario se ha actualizado con éxito!']);
        } else {
        	return response()->json(['status' => 'error', 'message' => 'No existe el Usuario especificado!']);
        }
    }

    public function eliminarUsuarioAPI($id) {
    	if ($id == "") {
            return response()->json(['status' => 'error', 'message' => 'Debe agregar el Id de Usuario!']);       
        } elseif (!is_numeric($id)) {
            return response()->json(['status' => 'error', 'message' => 'El Id de Usuario debe ser un valor numérico!']);
        }

    	$usuario = DB::delete("DELETE FROM users WHERE id = " .$id);

    	if ($usuario) {
    		DB::delete("DELETE FROM balance WHERE UserId = " .$id);

    		return response()->json(['status' => 'ok', 'message' => 'El Usuario se ha eliminado con éxito!']);
    	} else {
    		return response()->json(['status' => 'error', 'message' => 'No existe el Usuario especificado!']);
    	}
    }
}