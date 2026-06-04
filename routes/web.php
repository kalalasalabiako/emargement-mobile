<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ApiSeancesController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiEmargementsController;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

Route::get('/mobile', function () {
    return view('mobile');
})->name('mobile');

Route::get('/', function () {
    if (Auth::check()) {
        return response('', 302)->header('Location', '/accueil');
    }
    return view('connexion');
})->name('login');

Route::post('/connexion', [ApiAuthController::class, 'login'])
    ->name('connexion.post');


// 🔐 Routes protégées
Route::middleware('auth')->group(function () {
Route::get('/accueil', [ApiSeancesController::class, 'index'])
->name('accueil');



Route::get('/deconnexion',
[ApiAuthController::class, 'logout']
)->name('deconnexion');

    Route::get('/emargements/{id}', [ApiSeancesController::class, 'show'])
        ->name('emargements');

    Route::post('/emargements', [ApiEmargementsController::class, 'store'])
                ->name('emargements.store');

    Route::get('/session', function () {
        return view('session');
    })->name('session');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/seances', [ApiSeancesController::class, 'index'])
        ->name('seances');

    Route::get('/helloworld2', function () {
        return view('helloworld2');
    })->name('helloworld2');

});
