<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Recrutement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contrat;

class RecrutementController extends Controller
{
    public function index()
    {
        $recrutements = Recrutement::latest()->paginate(10);
        return view('rh.recrutement.index', compact('recrutements'));
    }

    public function create()
    {
        return view('rh.recrutement.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('cv', 'public');
        }

        Recrutement::create($validated);

        return redirect()->route('rh.recrutement.index')->with('success', 'Candidat ajouté avec succès.');
    }

    public function show(Recrutement $recrutement)
    {
        return view('rh.recrutement.show', compact('recrutement'));
    }

    public function edit(Recrutement $recrutement)
    {
        return view('rh.recrutement.edit', compact('recrutement'));
    }

    public function update(Request $request, Recrutement $recrutement)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            // Supprimer l'ancien CV
            if ($recrutement->cv) {
                Storage::disk('public')->delete($recrutement->cv);
            }
            $validated['cv'] = $request->file('cv')->store('cv', 'public');
        }

        $recrutement->update($validated);

        return redirect()->route('rh.recrutement.index')->with('success', 'Candidat modifié avec succès.');
    }

    public function destroy(Recrutement $recrutement)
    {
        if ($recrutement->cv) {
            Storage::disk('public')->delete($recrutement->cv);
        }
        $recrutement->delete();
        return redirect()->route('rh.recrutement.index')->with('success', 'Candidat supprimé.');
    }

    public function accepter(Recrutement $recrutement)
    {
        $recrutement->update(['statut' => 'accepte']);
        return redirect()->back()->with('success', 'Candidat accepté.');
    }

    public function refuser(Recrutement $recrutement)
    {
        $recrutement->update(['statut' => 'refuse']);
        return redirect()->back()->with('success', 'Candidat refusé.');
    }

    public function generatePdf($id)
    {
        $contrat = Contrat::findOrFail($id);

        // Choisir la vue selon le type de contrat
        $view = match($contrat->type) {
            'cdi' => 'rh.contrats.pdf_cdi',
            'cdd' => 'rh.contrats.pdf_cdd',
            'stage' => 'rh.contrats.pdf_stage',
            default => 'rh.contrats.pdf_default',
        };

        $pdf = Pdf::loadView($view, compact('contrat'));
        return $pdf->stream('Contrat_'.$contrat->type.'_'.$contrat->id.'.pdf');
    }
}
