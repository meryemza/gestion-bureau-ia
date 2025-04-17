<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    // Méthode pour afficher le formulaire de demande de congé
    public function create()
    {
        return view('employe.demande-conge');
    }

    // Méthode pour traiter la soumission du formulaire de demande de congé
    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
        ]);

        // Enregistrer la demande de congé dans la base de données
        Conge::create([
            'user_id' => auth()->id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'statut' => 'En attente',
        ]);

        return redirect()->route('employe.conges.demande')->with('success', 'Demande envoyée avec succès !');
    }
}
