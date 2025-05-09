<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.login');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('welcome');
    Route::resource('/dossiers', DossierController::class);
    
    // Define all Liste routes explicitly instead of using resource
    Route::get('listes', [ListeController::class, 'index'])->name('listes.index');
    Route::post('listes', [ListeController::class, 'store'])->name('listes.store');
    Route::get('listes/{liste}', [ListeController::class, 'show'])->name('listes.show');
    Route::get('listes/{liste}/addFile', [ListeController::class, 'addFile'])->name('listes.addFile');
    Route::post('listes/{liste}/storeFile', [ListeController::class, 'storeFile'])->name('listes.storeFile');
    Route::post('listes/{id}/send', [ListeController::class, 'send'])->name('listes.send');
    Route::get('/listes/{id}/print', [ListeController::class, 'print'])->name('listes.print');
    Route::delete('/listes/{liste}/dossiers/{dossier}', [ListeController::class, 'removeDossier'])->name('listes.dossiers.remove');
});

