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
use App\Http\Controllers\RH\RecrutementController;
use App\Http\Controllers\Admin\DepenseController;
use App\Http\Controllers\SecurityAuditController;
use App\Http\Controllers\AuditeurController;

Route::get('/', fn () => view('welcome'));

// Routes générales authentifiées
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'rh' => redirect()->route('rh.dashboard'),
            'comptable' => redirect()->route('comptable.dashboard'),
            'auditeur' => redirect()->route('auditeur.dashboard'),
            default => redirect()->route('employe.dashboard'),
        };
    })->name('dashboard');

    // Redirection après login selon le rôle
    Route::get('/redirect-role', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'rh' => redirect()->route('rh.dashboard'),
            'comptable' => redirect()->route('comptable.dashboard'),
            'auditeur' => redirect()->route('auditeur.dashboard'),
            default => redirect()->route('employe.dashboard'),
        };
    });

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =================== ADMIN ===================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Congés
    Route::get('/conges', [AdminController::class, 'showConges'])->name('conges');
    Route::patch('/conge/accepter/{id}', [AdminController::class, 'accepterConge'])->name('accepterConge');
    Route::patch('/conge/refuser/{id}', [AdminController::class, 'refuserConge'])->name('refuserConge');

    // Membres
    Route::resource('membres', MembreController::class);

    // Projets
    Route::resource('projets', ProjetController::class);

    // Clients
    Route::resource('clients', ClientController::class);

    // Factures
    Route::resource('factures', FactureController::class);
    Route::get('factures/{facture}/pdf', [FactureController::class, 'exportPDF'])->name('factures.pdf');
    Route::post('factures/{facture}/relancer', [FactureController::class, 'relancer'])->name('factures.relancer');

    // Services & Tarifs
    Route::resource('services', ServiceController::class);

    // Salaires
    Route::resource('salaires', SalairesController::class);
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');

    // Dépenses
    Route::resource('depenses', DepenseController::class);

    Route::get('projets/{projet}/taches', [TacheController::class, 'index'])->name('projets.taches.index');
    Route::get('projets/{projet}/taches/create', [TacheController::class, 'create'])->name('taches.create');
    Route::post('projets/{projet}/taches', [TacheController::class, 'store'])->name('taches.store');
    Route::resource('taches', TacheController::class)->except(['index', 'create', 'store', 'show']);
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

    // Recrutement
    Route::resource('recrutement', RecrutementController::class);
    Route::patch('recrutement/{recrutement}/accepter', [RecrutementController::class, 'accepter'])->name('recrutement.accepter');
    Route::patch('recrutement/{recrutement}/refuser', [RecrutementController::class, 'refuser'])->name('recrutement.refuser');
});

// Routes de l'auditeur
Route::middleware(['auth', 'role:auditeur'])->prefix('auditeur')->name('auditeur.')->group(function () {
    // Route pour le tableau de bord
    Route::get('/dashboard', [AuditeurController::class, 'dashboard'])->name('dashboard');
    
    // Routes pour les services de l'auditeur
    Route::get('/services/audits', [AuditeurController::class, 'audits'])->name('services.audits');
    Route::get('/services/rapports', [AuditeurController::class, 'rapports'])->name('services.rapports');

    // Routes pour les audits de sécurité
    Route::get('/security-audits', [AuditeurController::class, 'securityAudits'])->name('security-audits.index');
    Route::get('/security-audits/create', [AuditeurController::class, 'createAudit'])->name('security-audits.create');
    Route::post('/security-audits', [AuditeurController::class, 'storeAudit'])->name('security-audits.store');
    Route::get('/security-audits/{securityAudit}', [AuditeurController::class, 'showAudit'])->name('security-audits.show');
    Route::post('/security-audits/{securityAudit}/start', [AuditeurController::class, 'startAudit'])->name('security-audits.start');
    Route::get('/security-audits/{securityAudit}/report', [AuditeurController::class, 'generateReport'])->name('security-audits.report');
});

require __DIR__.'/auth.php';
