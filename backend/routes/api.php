<?php

use Illuminate\Http\Request;
use illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\materielController;

Route::post('/connexion', [indexController::class, 'apiConnexion']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [IndexController::class, 'getUser']);
    Route::get('/liste-materiels', [materielController::class, 'listeMateriel']);
    Route::post('/enregistrer-materiel', [materielController::class, 'enregistrerMateriel']);
    Route::delete('deconnexion', [indexController::class, 'logout']);
    Route::get('/combo-region', [materielController::class, 'comboregion']);
    Route::get('/combo-shop', [materielController::class, 'comboshop']);
    Route::get('/combo-type-mat', [materielController::class, 'combotype']);
    Route::get('/combo-etat', [materielController::class, 'comboetat']);
});
