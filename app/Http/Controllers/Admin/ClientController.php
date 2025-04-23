<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Afficher la liste des clients
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    // Afficher le formulaire pour ajouter un client
    public function create()
    {
        return view('admin.clients.create');
    }

    // Enregistrer un nouveau client
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        // Vérifier le domaine de l’email (DNS MX)
        $email = $request->input('email');
        $domain = substr(strrchr($email, "@"), 1);

        if (!checkdnsrr($domain, "MX")) {
            return back()->withErrors(['email' => 'Le domaine de l’email ne semble pas valide.'])->withInput();
        }

        Client::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client ajouté avec succès.');
    }

    // Afficher un client spécifique
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    // Afficher le formulaire d’édition d’un client
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    // Mettre à jour un client
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        $email = $request->input('email');
        $domain = substr(strrchr($email, "@"), 1);

        if (!checkdnsrr($domain, "MX")) {
            return back()->withErrors(['email' => 'Le domaine de l’email ne semble pas valide.'])->withInput();
        }

        $client->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    // Supprimer un client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
