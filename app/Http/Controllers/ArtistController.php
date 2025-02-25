<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistFindRequest;
use Illuminate\Http\Request;
use App\Services\SpotifyService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;




class ArtistController extends Controller
{
    public function __construct(protected SpotifyService $spotify)
    {
    }

    /**
     * Busca artistas por su nombre
     * @param string $name El nombre del artista a buscar
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $messages = [
            'nombre.required' => "El parámetro 'nombre' no puede estar vacío.",
            'nombre.string' => "El parámetro 'nombre' ha de ser una cadena de texto.",
        ];


        $validator = Validator::make($request->query(), [
            /** @query */
            'nombre' => ['required', 'string']
        ], $messages);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $accessToken = $this->spotify->requestNewAccessToken();

        $nombre = $request->nombre;

        $req = http::withHeaders(["Authorization" => "Bearer $accessToken"])
            ->get("https://api.spotify.com/v1/search?q=$nombre&type=artist&limit=20&offset=0");

        $data = json_decode($req->body());

        return response()->json($data);
    }


}
