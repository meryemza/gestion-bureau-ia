<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projet;

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
        return view('admin.projets.create');
    }

    /**
     * Enregistre un nouveau projet dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'statut' => 'required|string',
        ]);

        Projet::create([
            'nom' => $request->titre,
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.projets')->with('success', 'Projet ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification d’un projet existant.
     */
    public function edit($id)
    {
        $projet = Projet::findOrFail($id);
        return view('admin.projets.edit', compact('projet'));
    }

    /**
     * Met à jour un projet dans la base de données.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'statut' => 'required|string',
        ]);

        $projet = Projet::findOrFail($id);
        $projet->update([
            'nom' => $request->titre,
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.projets')->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Supprime un projet.
     */
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();

        return redirect()->route('admin.projets')->with('success', 'Projet supprimé avec succès.');
    }
}
