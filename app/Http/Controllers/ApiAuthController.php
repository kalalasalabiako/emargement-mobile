<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $response = Http::baseUrl(config('services.api.url'))
            ->acceptJson()
            ->post('/auth/login', $data);

        if (! $response->successful()) {
            return back()->with('error', 'Email ou mot de passe incorrect.');
        }

        $payload = $response->json();

        $token = $payload['token'] ?? null;
        $userData = $payload['user'] ?? null;

        if (! $token || ! $userData) {
            return back()->with('error', 'Réponse inattendue du serveur.');
        }

        $user = User::updateOrCreate(
            ['email' => $userData['email']],
            [
                'name' => $userData['name'] ?? $userData['email'],
                'password' => Str::random(40),
            ]
        );

        Auth::login($user);

        Session::put('remote_auth_token', $token);
        Session::put('remote_user', $userData);

        return redirect()->intended('accueil');
    }

    public function logout(Request $request)
    {
        $token = Session::get('remote_auth_token');

        if ($token) {
            Http::baseUrl(config('services.api.url'))
                ->acceptJson()
                ->withToken($token)
                ->post('/auth/logout');
        }

        Session::forget('remote_auth_token');
        Session::forget('remote_user');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
