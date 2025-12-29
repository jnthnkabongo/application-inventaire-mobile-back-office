<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\materielController;
use Illuminate\Support\Facades\Route;

Route::get('/', [indexController::class, 'index'])->name('index');
Route::post('/soumission', [indexController::class, 'create'])->name('soumission');
Route::get('/administration', [indexController::class, 'administration'])->name('administration');
Route::get('/liste-materiels', [materielController::class, 'liste_materiels'])->name('liste-materiels');
Route::get('/liste-utilisateurs', [materielController::class, 'liste_utilisateurs'])->name('liste-utilisateurs');
Route::get('/liste-regions', [materielController::class, 'liste_regions'])->name('liste-regions');
Route::get('/liste-shops', [materielController::class, 'liste_shops'])->name('liste-shops');
Route::get('/liste-type-materiels', [materielController::class, 'type_materiels'])->name('liste-type-materiels');
Route::get('rapports', [materielController::class, 'rapport'])->name('rapport');
