<?php 
namespace App\Http\Controllers\RH;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Contrat;
use App\Models\Employe;
use Illuminate\Support\Facades\Storage;

class ContratController extends Controller
{
    public function index()
    {
        $contrats = Contrat::with('employe')->latest()->get();
        return view('rh.contrats.index', compact('contrats'));
    }

    public function create()
    {
        $employes = Employe::all();
        return view('rh.contrats.create', compact('employes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'type' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire' => 'required|numeric',
            'statut' => 'required|in:actif,expiré',
            'document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('contrats', 'public');
        }

        Contrat::create($data);
        return redirect()->route('contrats.index')->with('success', 'Contrat ajouté avec succès.');
    }

    public function show(Contrat $contrat)
    {
        $contrat->load('employe');
        return view('rh.contrats.show', compact('contrat'));
    }

    public function edit(Contrat $contrat)
    {
        $employes = Employe::all();
        return view('rh.contrats.edit', compact('contrat', 'employes'));
    }

    public function update(Request $request, Contrat $contrat)
    {
        $data = $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'type' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire' => 'required|numeric',
            'statut' => 'required|in:actif,expiré',
            'document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('document')) {
            // supprimer l’ancien fichier si présent
            if ($contrat->document) {
                Storage::disk('public')->delete($contrat->document);
            }
            $data['document'] = $request->file('document')->store('contrats', 'public');
        }

        $contrat->update($data);
        return redirect()->route('contrats.index')->with('success', 'Contrat modifié avec succès.');
    }

    public function destroy(Contrat $contrat)
    {
        if ($contrat->document) {
            Storage::disk('public')->delete($contrat->document);
        }
        $contrat->delete();
        return redirect()->route('contrats.index')->with('success', 'Contrat supprimé avec succès.');
    }
}