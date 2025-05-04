<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Admin\TacheController;
use App\Http\Controllers\RH\AbsenceController;
use App\Http\Controllers\RH\ContratController;
use App\Http\Controllers\RH\SalairesController;
use App\Http\Controllers\RH\StatistiqueController;
use App\Http\Controllers\ServiceController;

Route::get('/', fn () => view('welcome'));

// Tableau de bord général
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Redirection après login selon le rôle
    Route::get('/redirect-role', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect()->route('dashboard.admin'),
            'rh' => redirect()->route('dashboard.rh'),
            'comptable' => redirect()->route('dashboard.comptable'),
            default => redirect()->route('dashboard.employe'),
        };
    });

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboards par rôle
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dashboard/rh', [DashboardController::class, 'index'])->name('dashboard.rh');
    Route::get('/dashboard/comptable', [ComptableController::class, 'index'])->name('dashboard.comptable');
    Route::get('/dashboard/employe', [EmployeController::class, 'index'])->name('dashboard.employe');
});

// =================== ADMIN ===================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/conges', [AdminController::class, 'showConges'])->name('conges');
    Route::patch('/conge/accepter/{id}', [AdminController::class, 'accepterConge'])->name('accepterConge');
    Route::patch('/conge/refuser/{id}', [AdminController::class, 'refuserConge'])->name('refuserConge');

    Route::resource('membres', MembreController::class)->only(['index']);
    Route::resource('projets', ProjetController::class)->except(['show', 'edit', 'update']);
    Route::resource('clients', ClientController::class);
    Route::resource('factures', FactureController::class);

    Route::get('factures/{facture}/pdf', [FactureController::class, 'exportPDF'])->name('factures.pdf');
    Route::post('factures/{facture}/relancer', [FactureController::class, 'relancer'])->name('factures.relancer');

    Route::get('projets/{projet}/taches', [TacheController::class, 'index'])->name('projets.taches.index');
    Route::get('projets/{projet}/taches/create', [TacheController::class, 'create'])->name('taches.create');
    Route::post('projets/{projet}/taches', [TacheController::class, 'store'])->name('taches.store');
    Route::resource('taches', TacheController::class)->except(['index', 'create', 'store', 'show']);
    
    Route::resource('services', ServiceController::class);
});

// =================== EMPLOYE ===================
Route::middleware(['auth', 'role:employe'])->prefix('employe')->name('employe.')->group(function () {
    Route::get('/conges/demande', [CongeController::class, 'create'])->name('conges.demande');
    Route::post('/conges/store', [CongeController::class, 'store'])->name('conges.store');
    Route::get('/conges', [EmployeController::class, 'mesConges'])->name('mes_conges');
});

// =================== RH ===================
Route::middleware(['auth', 'role:rh'])->prefix('rh')->name('rh.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Absences
    Route::resource('absences', AbsenceController::class);
    Route::get('/absences/index', [AbsenceController::class, 'showAbsencesByMonth'])->name('absences.byMonth');

    // Contrats
    Route::resource('contrats', ContratController::class);
    Route::get('contrats/{id}/pdf', [ContratController::class, 'generatePdf'])->name('contrats.pdf');

    // Salaires
    Route::resource('salaires', SalairesController::class);
    Route::get('salaires/{id}/pdf', [SalairesController::class, 'generatePDF'])->name('salaires.pdf');

    // Statistiques
    Route::get('stats', [StatistiqueController::class, 'index'])->name('stats.index');
});

require __DIR__.'/auth.php';
