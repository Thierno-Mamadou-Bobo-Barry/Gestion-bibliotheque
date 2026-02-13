<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\LivreController;

Route::middleware(['auth', 'role:Rbibliothecaire'])
    ->resource('livres', LivreController::class);

use App\Http\Controllers\CategorieController;

Route::middleware(['auth', 'role:Rbibliothecaire'])
    ->resource('categories', CategorieController::class);

use App\Http\Controllers\AuteurController;

Route::middleware(['auth', 'role:Rbibliothecaire'])
    ->resource('auteurs', AuteurController::class);

use App\Http\Controllers\EmpruntController;

Route::middleware(['auth', 'role:Rlecteur'])
    ->resource('emprunts', EmpruntController::class)
    ->only(['index', 'store']);

use App\Http\Controllers\CatalogueController;

Route::middleware(['auth', 'role:Rlecteur'])->group(function () {
    Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue.index');
});


use App\Http\Controllers\GestionEmpruntsController;

Route::middleware(['auth', 'role:Rbibliothecaire'])->group(function () {
    Route::get('/gestion-emprunts', [GestionEmpruntsController::class, 'index'])->name('gestion_emprunts.index');
    Route::post('/gestion-emprunts/{emprunt}/retour', [GestionEmpruntsController::class, 'retour'])->name('gestion_emprunts.retour');
});


use App\Http\Controllers\PenaliteController;

Route::middleware(['auth', 'role:Rlecteur'])->group(function () {
    Route::get('/mes-penalites', [PenaliteController::class, 'mesPenalites'])->name('penalites.mes');
});

Route::middleware(['auth', 'role:Rbibliothecaire'])->group(function () {
    Route::post('/penalites/{penalite}/payer', [PenaliteController::class, 'payer'])->name('penalites.payer');
});

use App\Http\Controllers\AdminStatsController;

Route::middleware(['auth', 'role:Radmin'])->get('/admin/stats', [AdminStatsController::class, 'index'])
    ->name('admin.stats');


use App\Http\Controllers\AdminUserController;

Route::middleware(['auth', 'role:Radmin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/toggle', [AdminUserController::class, 'toggleActif'])->name('admin.users.toggle');
    Route::post('/admin/users/{user}/role', [AdminUserController::class, 'changeRole'])->name('admin.users.role');
});
