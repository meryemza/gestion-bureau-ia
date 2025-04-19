<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\User;  // Assurez-vous d'ajouter le modèle User pour la gestion des employés

class ProjetController extends Controller
{
    /**
     * Affiche la liste des projets.
     */
    public function index()
    {
        $projets = Projet::latest()->get();
        return view('admin.projets.index', compact('projets'));
    }

    /**
     * Affiche le formulaire de création d’un projet.
     */
    public function create()
    {
        // Récupère uniquement les utilisateurs avec le rôle "employe"
        $employes = User::where('role', 'employe')->get();
    
        return view('admin.projets.create', compact('employes'));
    }

    /**
     * Enregistre un nouveau projet dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $request->validate([
            'nom' => 'required|string|max:255',    // Le nom du projet est obligatoire
            'statut' => 'required|string',          // Le statut est obligatoire
            'date_debut' => 'required|date',        // La date de début est obligatoire et doit être une date valide
            'date_fin' => 'required|date',          // La date de fin est obligatoire
            'description' => 'nullable|string|max:1000',  // La description est facultative
            'employes' => 'required|array',         // Validation pour s'assurer que des employés sont sélectionnés
            'employes.*' => 'exists:users,id',      // Validation pour vérifier que chaque employé existe dans la base de données
        ]);

        // Création d'un nouveau projet dans la base de données
        $projet = Projet::create([
            'nom' => $request->nom,
            'statut' => $request->statut,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'description' => $request->description,
        ]);

        // Attache les employés sélectionnés au projet
        $projet->employes()->attach($request->employes);

        // Redirection vers la liste des projets avec un message de succès
        return redirect()->route('admin.projets')->with('success', 'Projet ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification d’un projet existant.
     */
    public function edit($id)
    {
        $projet = Projet::findOrFail($id);  // Récupère le projet à modifier
        $employes = User::all();            // Récupère tous les employés
        return view('admin.projets.edit', compact('projet', 'employes'));
    }

    /**
     * Met à jour un projet dans la base de données.
     */
    public function update(Request $request, $id)
    {
        // Validation des données envoyées par le formulaire
        $request->validate([
            'nom' => 'required|string|max:255',  // Le nom du projet est obligatoire
            'statut' => 'required|string',       // Le statut est obligatoire
            'date_debut' => 'required|date',     // La date de début est obligatoire
            'date_fin' => 'required|date',       // La date de fin est obligatoire
        ]);

        // Récupère le projet à modifier
        $projet = Projet::findOrFail($id);

        // Met à jour le projet avec les nouvelles données
        $projet->update([
            'nom' => $request->nom,               // Le nom du projet
            'statut' => $request->statut,         // Le statut du projet
            'date_debut' => $request->date_debut, // La date de début
            'date_fin' => $request->date_fin,     // La date de fin
        ]);

        // Met à jour les employés associés
        $projet->employes()->sync($request->employes); // Utilisation de `sync` pour mettre à jour les employés associés

        // Redirection vers la liste des projets avec un message de succès
        return redirect()->route('admin.projets')->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Supprime un projet de la base de données.
     */
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();  // Suppression du projet

        // Redirection vers la liste des projets avec un message de succès
        return redirect()->route('admin.projets')->with('success', 'Projet supprimé avec succès.');
    }
}
