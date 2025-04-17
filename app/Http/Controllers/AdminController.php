<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use Carbon\Carbon;

class AdminController extends Controller
{
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
        $depenses = Depense::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Préparer les labels (mois) et les données (totaux des dépenses)
        $labels = [];
        $data = [];

        foreach ($depenses as $depense) {
            // Utiliser Carbon pour formater le mois
            $labels[] = Carbon::create()->month($depense->mois)->format('F'); // Ex: "January", "February", ...
            $data[] = $depense->total; // Total des dépenses pour le mois
        }

        // Retourner la vue avec les données
        return view('dashboard.admin', [
            'stats' => $stats,   // Statistiques générales
            'labels' => $labels, // Labels du graphique (mois)
            'data' => $data      // Données du graphique (totaux des dépenses)
        ]);
    }
}
