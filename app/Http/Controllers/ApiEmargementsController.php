<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class ApiEmargementsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'signature' => ['required', 'string'],
            'seance_id' => ['required', 'integer'],
        ]);

        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->withToken(Session::get('remote_auth_token'))
            ->post('/emargements', $data);

        if ($response->failed()) {
            return back()->with('error', 'Erreur lors de l’enregistrement de la signature.');
        }

        return redirect()
         ->route('emargements', ['id' => $data['seance_id']])
            ->with('status', 'Signature enregistrée avec succès.');
    }
}
