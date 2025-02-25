<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\{Cache, Http};

class SpotifyService
{
    protected mixed $idCliente;
    protected mixed $secretCliente;

    public function __construct()
    {
        $this->idCliente = config('services.spotify.client_id');
        $this->secretCliente = config('services.spotify.client_secret');
    }

    public function getAccessToken()
    {
        $token = Cache::get('spotify_access_token');
        $fechaExpiracion = Cache::get('spotify_token_expires_at');

        if ($token && $fechaExpiracion && Carbon::now()->lt($fechaExpiracion)) {
            return $token;
        }

        return $this->requestNewAccessToken();
    }

    /**
     * Este metodo pide un nuevo access token a la api de spotify y lo guarda en cache durante una hora.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function requestNewAccessToken()
    {
        $res = http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->idCliente,
            'client_secret' => $this->secretCliente,
        ]);

        $data = json_decode($res->body());

        // Si la petición ha tenido éxito, se guarda el token de spotify en caché y se devuelve el token
        if ($res->successful()) {
            $token = $data->access_token;
            $expiraSegundos = $data->expires_in;

            Cache::put('spotify_access_token', $token, $expiraSegundos);
            Cache::put('spotify_token_expires_at', now()->addSeconds($expiraSegundos), $expiraSegundos);

            return $token;
        }

        // Si la petición no ha tenido éxito se devuelve un mensaje de error
        return response()->json(
            [
                "message" => "Ha habido un error al obtener el token de acceso",
                "message2" => $data->error_description,
                "statusCode" => 400,
            ]
        );

    }

}
