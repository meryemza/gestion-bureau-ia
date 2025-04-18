<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conge;

class EmployeController extends Controller
{
    /**
     * Affiche le tableau de bord de l'employé.
     */
    public function index()
    {
        return view('dashboard.employe');
    }

    /**
     * Affiche les demandes de congé de l'employé connecté.
     */
    public function mesConges()
    {
        // Vérifie si l'utilisateur est authentifié
        $user = Auth::user();  // Récupère l'utilisateur actuellement connecté

        // Si l'utilisateur n'est pas authentifié, redirige vers la page de login
        if (!$user) {
            return redirect()->route('login');  // Rediriger l'utilisateur vers la page de connexion
        }

        // Récupère tous les congés de l'employé, triés par date décroissante
        $conges = $user->conges()->latest()->get();

        // Retourne la vue avec les données des congés
        return view('employe.mes_conges', compact('conges'));
    }

    /**
     * Permet à l'employé de faire une demande de congé.
     */
    public function createConge()
    {
        return view('employe.demande_conge');
    }

    /**
     * Enregistre une nouvelle demande de congé.
     */
    public function storeConge(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
        ]);

        // Création de la demande de congé
        $conge = new Conge();
        $conge->user_id = Auth::id();
        $conge->date_debut = $validated['date_debut'];
        $conge->date_fin = $validated['date_fin'];
        $conge->motif = $validated['motif'];
        $conge->statut = 'En attente';  // Statut par défaut
        $conge->save();

        // Redirection avec message de succès
        return redirect()->route('employe.mes_conges')->with('success', 'Demande de congé envoyée avec succès.');
    }
}
