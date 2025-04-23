<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComptableController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\UserController; // Ajouté pour le UserController
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Admin\TacheController;
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
    Route::get('/dashboard/rh', [DashboardController::class, 'index'])->name('dashboard.rh');
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
Route::get('/admin/membres', [MembreController::class, 'index'])->name('admin.membres');

Route::get('/admin/projets', [ProjetController::class, 'index'])->name('admin.projets');
Route::get('/admin/projets/create', [ProjetController::class, 'create'])->name('admin.projets.create');
Route::delete('/admin/projets/{projet}', [ProjetController::class, 'destroy'])->name('admin.projets.destroy');
Route::post('/admin/projets', [ProjetController::class, 'store'])->name('admin.projets.store');
Route::get('/employe/conges', [\App\Http\Controllers\Employe\CongeController::class, 'mesConges'])->name('employe.mes_conges');
Route::get('/employe/conges', [EmployeController::class, 'mesConges'])->name('employe.mes_conges');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('services', App\Http\Controllers\ServiceController::class);
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
});


//Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    
    // Liste des factures
    Route::get('factures', [FactureController::class, 'index'])->name('factures.index');

    // Créer une facture
    Route::get('factures/create', [FactureController::class, 'create'])->name('factures.create');
    Route::post('factures', [FactureController::class, 'store'])->name('factures.store');

    // Voir une facture
    Route::get('factures/{facture}', [FactureController::class, 'show'])->name('factures.show');

    // Éditer une facture
    Route::get('factures/{facture}/edit', [FactureController::class, 'edit'])->name('factures.edit');
    Route::put('factures/{facture}', [FactureController::class, 'update'])->name('factures.update');

    // Supprimer une facture
    Route::delete('factures/{facture}', [FactureController::class, 'destroy'])->name('factures.destroy');

    // Exporter en PDF
    Route::get('factures/{facture}/pdf', [FactureController::class, 'exportPDF'])->name('factures.pdf');

    // Relancer par email
    Route::post('factures/{facture}/relancer', [FactureController::class, 'relancer'])->name('factures.relancer');
    Route::resource('factures', App\Http\Controllers\Admin\FactureController::class);
    Route::get('/factures/{id}/pdf', [FactureController::class, 'exportPDF'])->name('factures.exportPDF');
    Route::get('/projets/{projet}/taches/create', [TacheController::class, 'create'])->name('taches.create');
    Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');
    Route::get('/projets/{projet}/taches/create', [TacheController::class, 'create'])->name('taches.create');
Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');
// Liste des tâches pour un projet
Route::get('projets/{projet}/taches', [TacheController::class, 'index'])->name('projets.taches.index');

// Afficher le formulaire pour créer une tâche
Route::get('projets/{projet}/taches/create', [TacheController::class, 'create'])->name('taches.create');

// Enregistrer une tâche
Route::post('projets/{projet}/taches', [TacheController::class, 'store'])->name('taches.store');

// Modifier une tâche
Route::get('taches/{tache}/edit', [TacheController::class, 'edit'])->name('taches.edit');

// Mettre à jour une tâche
Route::put('taches/{tache}', [TacheController::class, 'update'])->name('taches.update');

// Supprimer une tâche
Route::delete('taches/{tache}', [TacheController::class, 'destroy'])->name('taches.destroy');

//});

Route::prefix('rh')->middleware(['auth:rh'])->name('rh.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('absences', App\Http\Controllers\RH\AbsenceController::class);
    Route::resource('salaires', App\Http\Controllers\RH\SalaireController::class);
    Route::get('stats', [App\Http\Controllers\RH\StatistiqueController::class, 'index'])->name('stats.index');
});





/*Route::middleware(['auth', 'role:rh'])->prefix('rh')->name('rh.')->group(function () {
    Route::resource('absences', App\Http\Controllers\RH\AbsenceController::class)->names('rh.absences');
    Route::resource('conges', App\Http\Controllers\RH\CongeController::class)->names('rh.conges');
    Route::resource('contrats', App\Http\Controllers\RH\ContratController::class)->names('rh.contrats');
    Route::resource('contrats', ContratController::class);
    Route::get('contrats', [ContratController::class, 'index'])->name('contrats.index');
    Route::get('contrats/create', [ContratController::class, 'create'])->name('contrats.create');
    Route::post('contrats', [ContratController::class, 'store'])->name('contrats.store');
});*/
require __DIR__.'/auth.php';