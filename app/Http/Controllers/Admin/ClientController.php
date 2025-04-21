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
            'nom' => 'required',
            'email' => 'required|email',
            // Ajoute d’autres validations si nécessaire
        ]);

        Client::create($request->all());
        return redirect()->route('admin.clients.index');
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
            'nom' => 'required',
            'email' => 'required|email',
        ]);

        $client->update($request->all());
        return redirect()->route('admin.clients.index');
    }

    // Supprimer un client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index');
    }
}
