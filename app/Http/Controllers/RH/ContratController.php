<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Assure-toi que barryvdh/laravel-dompdf est installé
use Carbon\Carbon;
class ContratController extends Controller
{
    // Liste des contrats
    public function index()
    {
        $contrats = Contrat::orderBy('created_at', 'desc')->get();
        return view('rh.contrats.index', compact('contrats'));
    }

    // Formulaire de création
    public function create()
    {
        return view('rh.contrats.create');
    }

    // Enregistrer un nouveau contrat
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employeur_nom' => 'required|string|max:255',
            'employeur_representant' => 'required|string|max:255',
            'employeur_fonction' => 'nullable|string|max:255',
            'employeur_code_ape' => 'nullable|string|max:255',
            'employeur_siret' => 'nullable|string|max:255',
            'employeur_adresse' => 'nullable|string|max:255',
    
            'employe_civilite' => 'required|string',
            'employe_nom' => 'required|string|max:255',
            'employe_prenom' => 'required|string|max:255',
            'employe_nationalite' => 'nullable|string|max:255',
            'employe_date_naissance' => 'nullable|date',
            'employe_lieu_naissance' => 'nullable|string|max:255',
            'employe_adresse' => 'nullable|string|max:255',
            'employe_num_securite_sociale' => 'nullable|string|max:255',
            'employe_num_agessa' => 'nullable|string|max:255',
    
            'type_contrat' => 'required|string',
            'date_debut' => 'nullable|date|before_or_equal:date_fin',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'nb_seances' => 'nullable|integer',
            'duree_seance' => 'nullable|numeric',
            'ville_urssaf' => 'nullable|string|max:255',
            'theme_atelier' => 'nullable|string|max:255',
            'lieu_intervention' => 'nullable|string|max:255',
            'classe_concernee' => 'nullable|string|max:255',
            'nom_enseignant' => 'nullable|string|max:255',
            'niveau_scolaire' => 'nullable|string|max:255',
            'nombre_eleves' => 'nullable|integer',
            'dates_heures_seances' => 'nullable|string|max:500',
        ]);
         
        $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d');
        $date_fin = $request->date_fin ? Carbon::parse($request->date_fin)->format('Y-m-d') : null;


        //Contrat::create($request->all());
        $contrat = new Contrat([
            'employeur_nom' => $request->employeur_nom,
            'employeur_representant' => $request->employeur_representant,
            'employeur_fonction' => $request->employeur_fonction,
            'employeur_code_ape' => $request->employeur_code_ape,
            'employeur_siret' => $request->employeur_siret,
            'employeur_adresse' => $request->employeur_adresse,
        
            'employe_civilite' => $request->employe_civilite,
            'employe_nom' => $request->employe_nom,
            'employe_prenom' => $request->employe_prenom,
            'employe_nationalite' => $request->employe_nationalite,
            'employe_date_naissance' => $request->employe_date_naissance,
            'employe_lieu_naissance' => $request->employe_lieu_naissance,
            'employe_adresse' => $request->employe_adresse,
            'employe_num_securite_sociale' => $request->employe_num_securite_sociale,
            'employe_num_agessa' => $request->employe_num_agessa,
        
            'type_contrat' => $request->type_contrat,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'nb_seances' => $request->nb_seances,
            'duree_seance' => $request->duree_seance,
            'ville_urssaf' => $request->ville_urssaf,
            'theme_atelier' => $request->theme_atelier,
            'lieu_intervention' => $request->lieu_intervention,
            'classe_concernee' => $request->classe_concernee,
            'nom_enseignant' => $request->nom_enseignant,
            'niveau_scolaire' => $request->niveau_scolaire,
            'nombre_eleves' => $request->nombre_eleves,
            'dates_heures_seances' => $request->dates_heures_seances,
        ]);
    
        // Sauvegarder le contrat dans la base de données
        $contrat->save();

        return redirect()->route('rh.contrats.index')->with('success', 'Contrat ajouté avec succès.');
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $contrat = Contrat::findOrFail($id);
        return view('rh.contrats.edit', compact('contrat'));
    }

    // Mise à jour d’un contrat
    public function update(Request $request, $id)
    {
        $request->validate([
            'employe' => 'required|string|max:255',
            'type' => 'required|in:CDI,CDD,Stage',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'statut' => 'required|in:Actif,En cours,Terminé',
        ]);

        $contrat = Contrat::findOrFail($id);
        $contrat->update($request->all());

        return redirect()->route('rh.contrats.index')->with('success', 'Contrat mis à jour avec succès.');
    }

    // Suppression
    public function destroy($id)
    {
        Contrat::destroy($id);
        return redirect()->route('rh.contrats.index')->with('success', 'Contrat supprimé avec succès.');
    }

    // Affichage PDF

/*public function generatePdf($id)
{
    $contrat = Contrat::findOrFail($id);
    $pdf = Pdf::loadView('rh.contrats.pdf', compact('contrat'));
    return $pdf->stream("contrat_{$contrat->id}.pdf");
}

    public function showPdf($id)
    {
        $contrat = Contrat::findOrFail($id);
        $pdf = PDF::loadView('rh.contrats.pdf', compact('contrat'));
        return $pdf->stream("Contrat_{$contrat->id}.pdf");
    }*/
    public function generatePdf($id)
{
    // Récupérer le contrat
    $contrat = Contrat::with('employe', 'employeur')->findOrFail($id);

    // Générer le PDF à partir de la vue Blade
    $pdf = Pdf::loadView('contrats.pdf', compact('contrat'));

    // Télécharger le PDF
    return $pdf->download('contrat_' . $contrat->employe->nom . '.pdf');
}
}
