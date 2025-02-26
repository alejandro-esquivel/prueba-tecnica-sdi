<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    /**
     * Registro
     *
     * Este endpoint le permite registrarse al usuario. Al no existir
     * un proceso de verificación de email, se verifica automáticamente al registrarse.
     * @param \App\Http\Requests\RegisterRequest $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $user->email_verified_at = now();
        $user->save();

        return response()->json(["message" => "Se ha creado el usuario"], 200);
    }

    /**
     * Login
     *
     * Este enpoint le permite al usuario iniciar sesión
     * @param \Illuminate\Http\Request $req
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(Request $req)
    {

        return response()->json(['name' => 'prueba']);
    }

    /**
     * Logout
     *
     * Este endpoint permite al usuario cerrar sesión
     * @return void
     */
    public function logout()
    {

    }
}
