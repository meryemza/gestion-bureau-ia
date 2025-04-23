<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Facture;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('client')->get();
        return view('admin.factures.index', compact('factures'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.factures.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'titre' => 'required|string|max:255',
            'montant' => 'required|numeric',
            'statut' => 'required|in:payée,en attente,relancée',
            'date_echeance' => 'nullable|date',
        ]);

        Facture::create($request->all());

        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
    }

    public function edit($id)
    {
        $facture = Facture::findOrFail($id);
        $clients = Client::all();
        return view('admin.factures.edit', compact('facture', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $facture = Facture::findOrFail($id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'statut' => 'required|string',
        ]);

        $facture->update($request->all());

        return redirect()->route('factures.index')->with('success', 'Facture mise à jour.');
    }

    public function destroy($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->delete();

        return redirect()->route('factures.index')->with('success', 'Facture supprimée.');
    }
    public function show($id)
{
    $facture = Facture::with('client')->findOrFail($id);
    return view('admin.factures.show', compact('facture'));
}
public function exportPDF($id)
{
    $facture = Facture::with('client')->findOrFail($id);
    $pdf = Pdf::loadView('admin.factures.pdf', compact('facture'));


    // Affiche dans le navigateur :
    return $pdf->stream("facture_{$facture->id}.pdf");

    // Ou télécharge directement :
    // return $pdf->download("facture_{$facture->id}.pdf");
}

}

