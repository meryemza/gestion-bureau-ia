<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use App\Models\Conge;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Affiche le dashboard admin avec les statistiques et la liste des congés.
     */
    public function index()
    {
        // Statistiques fictives ou issues d'autres modèles
        $stats = [
            'activity_rate' => 20.6,
            'user_count' => 66,
            'sessions' => 11,
            'active_users' => 212,
        ];

        // Récupérer les données de dépenses par mois
        $depenses = Depense::selectRaw('YEAR(date) as annee, MONTH(date) as mois, SUM(montant) as total')
            ->groupBy('annee', 'mois')
            ->orderBy('annee', 'asc')
            ->orderBy('mois', 'asc')
            ->get();

        // Préparer les labels (mois) et les données (totaux des dépenses)
        $labels = [];
        $data = [];

        foreach ($depenses as $depense) {
            $labels[] = Carbon::create($depense->annee, $depense->mois)->translatedFormat('F Y'); // ex: Avril 2025
            $data[] = $depense->total;
        }

        // Récupérer les congés avec les infos de l'employé
        $conges = Conge::with('user')->latest()->get();

        // Retourner la vue avec les données
        return view('dashboard.admin', [
            'stats' => $stats,    // Statistiques générales
            'labels' => $labels,  // Labels du graphique (mois)
            'data' => $data,      // Données du graphique (totaux des dépenses)
            'conges' => $conges   // Liste des congés
        ]);
    }

    /**
     * Affiche la liste des congés avec les options pour les accepter ou les refuser.
     */
    public function showConges()
    {
        // Récupérer tous les congés avec les informations nécessaires
        $conges = Conge::all();

        // Retourner la vue avec la liste des congés
        return view('admin.conges', compact('conges'));
    }

    /**
     * Accepte un congé et met à jour son statut.
     */
    public function accepterConge($id)
    {
        // Recherche le congé par son ID
        $conge = Conge::find($id);

        if ($conge) {
            // Modifie le statut du congé à "Accepté"
            $conge->statut = 'Accepté';
            $conge->save(); // Sauvegarde les changements dans la base de données
        }

        // Redirige l'admin avec un message de succès
        return redirect()->route('admin.conges')->with('success', 'Congé accepté');
    }

    /**
     * Refuse un congé et met à jour son statut.
     */
    public function refuserConge($id)
    {
        // Recherche le congé par son ID
        $conge = Conge::find($id);

        if ($conge) {
            // Modifie le statut du congé à "Refusé"
            $conge->statut = 'Refusé';
            $conge->save(); // Sauvegarde les changements dans la base de données
        }

        // Redirige l'admin avec un message d'erreur
        return redirect()->route('admin.conges')->with('error', 'Congé refusé');
    }
}

