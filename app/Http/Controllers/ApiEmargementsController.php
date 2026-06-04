<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApiEmargementController extends Controller
{
    public function store(Request $request)

    {
    $data = $request->validate([
    'emargements' => ['required', 'string'],
    'seances_id' => ['required', 'integer'],
    ]);

    $data ['user_id'] = Auth::id();

    $reponse = Http::baseUrl(config('services.api.url'))
    ->acceptJson()
    ->withToken(
        Session::get('remote_auth_token'))
        ->post('/emargements', $data);

        if ($reponse->successful()) {
                // Traiter la réponse réussie
           return back()->with('error', 'Erreur lors de l\'enregistrement de la signature distante.');
                // Gérer les erreurs
            }
return redirect()->route('acceuil')->with('status', 'Signature enregistrée avec succès.');

    }

    //
}
