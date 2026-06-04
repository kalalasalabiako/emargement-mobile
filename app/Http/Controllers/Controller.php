<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Connexion réussie'
            ]);
        }

        return response()->json([
            'message' => 'Email ou mot de passe incorrect'
        ], 401);
    }
}
