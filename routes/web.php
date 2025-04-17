<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RhController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\UserController; // Ajouté pour le UserController
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route de la page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Route du tableau de bord principal
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes liées au profil de l'utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirection en fonction du rôle après la connexion
Route::get('/redirect-role', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect('/dashboard/admin'),
        'rh' => redirect('/dashboard/rh'),
        'comptable' => redirect('/dashboard/comptable'),
        default => redirect('/dashboard/employe'),
    };
})->middleware(['auth']);

// Routes pour les tableaux de bord spécifiques en fonction des rôles
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dashboard/rh', [RhController::class, 'index'])->name('dashboard.rh');
    Route::get('/dashboard/comptable', [ComptableController::class, 'index'])->name('dashboard.comptable');
    Route::get('/dashboard/employe', [EmployeController::class, 'index'])->name('dashboard.employe');
});


require __DIR__.'/auth.php';

