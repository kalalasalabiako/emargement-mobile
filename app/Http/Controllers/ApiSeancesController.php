<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

//BTS BLANC
use App\Models\User;
use App\Models\Emargements;

class ApiSeancesController extends Controller
{
    public function index()
    {
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(
                    Session::get('remote_auth_token'))
            ->get('/seances');

        if ($response->failed()) {
            abort($response->status(), 'Impossible de récupérer les séances');
        }

        return view('accueil', [
            'seances' => $response->json(),
        ]);
    }
public function show($id)
{
    $response = Http::baseUrl(config('services.api.url'))
        ->acceptJson()
        ->withToken(Session::get('remote_auth_token'))
        ->get("/seances/{$id}");

    $apprenants = Http::baseUrl(config('services.api.url'))
        ->acceptJson()
        ->withToken(Session::get('remote_auth_token'))
        ->get("/seances/{$id}/apprenants");

    return view('emargements', [
        'seance' => $response->json(),
        'apprenants' => $apprenants->json(),
    ]);
}
//BTS BLANC
/* public function apprenants($id)
{
    // trop !!!
    //$users = User::all();

    // 1. récupérer la seance en fonction de l'id
    // $seance = API

    // $seance->formation_id

    // 2. récupérer les la formation en fonction de l'id
    // $formation

    // $users = $formations users

   /* $emargements = Emargements::where('seance_id', $id)->get();

    $result = $users->map(function ($user) use ($emargements) {

        $signe = $emargements->contains('user_id', $user->id);

        return [
            'id' => $user->id,
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'signe' => $signe
        ];
    });

    return response()->json($result);
} */

}
