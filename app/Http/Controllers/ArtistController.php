<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistFindRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Services\SpotifyService;




class ArtistController extends Controller
{
    public function __construct(protected SpotifyService $spotify)
    {
    }

    /**
     * search
     *
     * Este endpoint permite al usuario buscar artistas por su nombre
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


    /**
     * get
     *
     * Este endpoint permite al usuario obtener la información de un artista
     * @param string $id Id del artista.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function get(string $id)
    {
        if (isset($id)) {
            $accessToken = $this->spotify->requestNewAccessToken();

            $req = http::withHeaders(["Authorization" => "Bearer $accessToken"])
                ->get("https://api.spotify.com/v1/artists/$id");

            if ($req->ok()) {
                $data = json_decode($req->body());

                return response()->json($data);
            }

            return response()->json([
                "message" => "El ID introducido no es válido"
            ], 400);

        }

        return response()->json([
            "message" => "No se ha proporcionado un ID de artista"
        ], 400);
    }

    /**
     * getAlbums
     *
     * Este parámetro le permite al usuario obtener los álbumes de un artista.
     * @param string $id Id del artista.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getAlbums(string $id)
    {
        if (isset($id)) {
            $accessToken = $this->spotify->requestNewAccessToken();

            $req = http::withHeaders(["Authorization" => "Bearer $accessToken"])
                ->get("https://api.spotify.com/v1/artists/$id/albums");

            if ($req->ok()) {
                $data = json_decode($req->body());

                return response()->json($data);
            }

            return response()->json([
                "message" => "El ID introducido no es válido"
            ], 400);

        }

        return response()->json([
            "message" => "No se ha proporcionado un ID de artista"
        ], 400);
    }


}
