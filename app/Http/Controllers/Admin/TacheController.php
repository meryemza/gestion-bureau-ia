<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tache;
use App\Models\Projet;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    // Liste des tâches d’un projet
    public function index(Projet $projet)
    {
        $taches = $projet->taches()->latest()->get();
        return view('admin.projets.taches.index', compact('projet', 'taches'));


    }

    // Formulaire pour créer une tâche
    public function create(Projet $projet)
    {
        return view('admin.projets.taches.create', compact('projet'));

    }

    // Stocker une nouvelle tâche
    public function store(Request $request, Projet $projet)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|in:en_attente,en_cours,terminee',
            'priorite' => 'required|in:basse,moyenne,haute',
            // PAS besoin de valider projet_id ici !
        ]);
    
        Tache::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'statut' => $request->statut,
            'priorite' => $request->priorite,
            'projet_id' => $projet->id, // <- utilise l'objet $projet
        ]);
    
        return redirect()->route('projets.taches.index', $projet->id)
                         ->with('success', 'Tâche ajoutée avec succès.');
    }
     
    public function show(Tache $tache)
    {
        return view('taches.show', compact('tache'));
    }

    // Formulaire pour éditer une tâche
    public function edit(Tache $tache)
    {
        return view('admin.projets.taches.edit', compact('tache'));
    }

    // Mettre à jour une tâche
    public function update(Request $request, Tache $tache)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|in:en_attente,en_cours,terminee',
            'priorite' => 'required|in:basse,moyenne,haute',
            'projet_id' => 'required|exists:projets,id',
        ]);

        $tache->update($request->only('titre', 'description', 'statut', 'priorite'));

        return redirect()->route('projets.taches.index', $tache->projet_id)->with('success', 'Tâche mise à jour avec succès.');
    }

    // Supprimer une tâche
    public function destroy(Tache $tache)
    {
        $projet_id = $tache->projet_id;
        $tache->delete();

        return redirect()->route('projets.taches.index', $projet_id)->with('success', 'Tâche supprimée avec succès.');
    }
}
