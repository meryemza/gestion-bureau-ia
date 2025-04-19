<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RhController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\UserController; // Ajouté pour le UserController
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\ProjectController;

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
Route::get('employe/conges/demande', [CongeController::class, 'create'])->name('employe.conges.demande');
Route::post('employe/conges/store', [CongeController::class, 'store'])->name('employe.conges.store');
// Route pour la page des congés
Route::get('/admin/conges', [AdminController::class, 'showConges'])->name('admin.conges')->middleware(['auth', 'is_admin']);
Route::patch('/admin/conge/accepter/{id}', [AdminController::class, 'accepterConge'])->name('admin.accepterConge');
Route::patch('/admin/conge/refuser/{id}', [AdminController::class, 'refuserConge'])->name('admin.refuserConge');
Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::middleware(['auth', 'role:rh'])->group(function () {
    Route::get('/rh/dashboard', [RhController::class, 'index'])->name('rh.dashboard');
    Route::get('/conges', [CongesController::class, 'index'])->name('conges.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/salaires', [SalaireController::class, 'index'])->name('salaire.index');
Route::resource('projects', ProjectController::class);
});

require __DIR__.'/auth.php';

