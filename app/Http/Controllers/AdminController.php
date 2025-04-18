<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use App\Models\Conge;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Affiche le dashboard admin avec les statistiques et la liste des congés en attente.
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

        // Récupérer uniquement les congés en attente avec les infos de l'employé
        $conges = Conge::with('user')
            ->where('statut', 'En attente')
            ->latest()
            ->get();

        // Retourner la vue avec les données
        return view('dashboard.admin', [
            'stats' => $stats,
            'labels' => $labels,
            'data' => $data,
            'conges' => $conges
        ]);
    }

    /**
     * Affiche la liste complète des congés (acceptés, refusés, en attente).
     */
    public function showConges()
    {
        // Récupérer tous les congés avec les informations nécessaires
        $conges = Conge::with('user')->latest()->get();

        // Retourner la vue avec la liste des congés
        return view('admin.conges', compact('conges'));
    }

    /**
     * Accepte un congé et met à jour son statut.
     */
    public function accepterConge($id)
    {
        $conge = Conge::find($id);

        if ($conge) {
            $conge->statut = 'Accepté';
            $conge->save();
        }

        return redirect()->back()->with('success', 'Le congé a été accepté avec succès.');
    }

    /**
     * Refuse un congé et met à jour son statut.
     */
    public function refuserConge($id)
    {
        $conge = Conge::find($id);

        if ($conge) {
            $conge->statut = 'Refusé';
            $conge->save();
        }

        return redirect()->back()->with('error', 'Le congé a été refusé.');
    }
}
