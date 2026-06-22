<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ApiSeancesController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Récupération du token de connexion
        |--------------------------------------------------------------------------
        */
        $token = Session::get('remote_auth_token');

        /*
        |--------------------------------------------------------------------------
        | Si aucun token n'existe, on renvoie vers la page de connexion
        |--------------------------------------------------------------------------
        */
        if (! $token) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | Appel de l'API web pour récupérer les séances
        |--------------------------------------------------------------------------
        */
        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken($token)
            ->get('/seances');

        /*
        |--------------------------------------------------------------------------
        | Si l'API échoue, on affiche l'accueil avec aucune séance
        |--------------------------------------------------------------------------
        */
        if (! $response->successful()) {
            return view('accueil', [
                'seances' => [],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Récupération des données envoyées par l'API
        |--------------------------------------------------------------------------
        */
        $data = $response->json();

        /*
        |--------------------------------------------------------------------------
        | Sécurité : si l'API ne renvoie pas un tableau, on met un tableau vide
        |--------------------------------------------------------------------------
        */
        $seances = is_array($data) ? $data : [];

        /*
        |--------------------------------------------------------------------------
        | Affichage de l'accueil avec les séances
        |--------------------------------------------------------------------------
        */
        return view('accueil', [
            'seances' => $seances,
        ]);
    }

    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Récupération du token de connexion
        |--------------------------------------------------------------------------
        */
        $token = Session::get('remote_auth_token');

        /*
        |--------------------------------------------------------------------------
        | Si aucun token n'existe, on renvoie vers la connexion
        |--------------------------------------------------------------------------
        */
        if (! $token) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | Appel de l'API pour récupérer la séance sélectionnée
        |--------------------------------------------------------------------------
        */
        $responseSeance = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken($token)
            ->get("/seances/{$id}");

        /*
        |--------------------------------------------------------------------------
        | Si la séance n'existe pas ou que l'API échoue, retour accueil
        |--------------------------------------------------------------------------
        */
        if (! $responseSeance->successful()) {
            return redirect()->route('accueil');
        }

        /*
        |--------------------------------------------------------------------------
        | Appel de l'API pour récupérer les apprenants liés à cette séance
        |--------------------------------------------------------------------------
        */
        $responseApprenants = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken($token)
            ->get("/seances/{$id}/apprenants");

        /*
        |--------------------------------------------------------------------------
        | Données envoyées à la page emargements.blade.php
        |--------------------------------------------------------------------------
        */
        return view('emargements', [
            'seance' => $responseSeance->json(),
            'apprenants' => $responseApprenants->successful()
                ? $responseApprenants->json()
                : [],
        ]);
    }
}
