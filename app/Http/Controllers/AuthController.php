<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
     * Este endpoint le permite al usuario iniciar sesión. Cuando obtiene el token se eliminan los anteriores para
     * evitar que se abuse de la API.
     * @param \Illuminate\Http\Request $req
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getToken(LoginRequest $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            ->first();

        $passwordIsCorrect = Hash::check($request->password, $user->password);

        if ($passwordIsCorrect) {
            $user->tokens()->delete();

            $token = $user->createToken($user->nombre . '-AuthToken')->plainTextToken;

            return response()->json([
                'access_token' => $token
            ]);
        }

        return response()->json(['message' => 'Las credenciales introducidas no son correctas'], 401);
    }

    /**
     * Logout
     *
     * Este endpoint permite al usuario cerrar sesión
     * @return void
     */
    public function revokeTokens()
    {
        auth()->user()->tokens()->delete();

        return response()->json(["message" => "Se ha cerrado la sesión"]);

    }
}
