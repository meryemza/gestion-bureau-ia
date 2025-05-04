@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white min-h-screen p-10">
    <div class="max-w-4xl mx-auto bg-[#1A1F3B] p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6">Ajouter un Nouveau Contrat</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rh.contrats.store') }}" method="POST">
            @csrf

            <!-- Informations sur l'employeur -->
            <h2 class="text-2xl font-semibold mb-4">Informations sur l'Employeur</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block mb-1 font-semibold">Nom de la structure</label>
                    <input type="text" name="employeur_nom" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Représentant légal</label>
                    <input type="text" name="employeur_representant" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Fonction</label>
                    <input type="text" name="employeur_fonction" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Code APE</label>
                    <input type="text" name="employeur_code_ape" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Numéro SIRET</label>
                    <input type="text" name="employeur_siret" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Adresse</label>
                    <input type="text" name="employeur_adresse" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
            </div>

            <!-- Informations sur l'employé -->
            <h2 class="text-2xl font-semibold mb-4">Informations sur l'Employé</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block mb-1 font-semibold">Civilité</label>
                    <select name="employe_civilite" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="Mme">Mme</option>
                        <option value="M.">M.</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Nom</label>
                    <input type="text" name="employe_nom" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Prénom</label>
                    <input type="text" name="employe_prenom" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Nationalité</label>
                    <input type="text" name="employe_nationalite" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Date de naissance</label>
                    <input type="date" name="employe_date_naissance" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Lieu de naissance</label>
                    <input type="text" name="employe_lieu_naissance" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Adresse</label>
                    <input type="text" name="employe_adresse" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Numéro de sécurité sociale</label>
                    <input type="text" name="employe_num_securite_sociale" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Numéro d'affiliation Agessa</label>
                    <input type="text" name="employe_num_agessa" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
            </div>

            <!-- Détails du contrat -->
            <h2 class="text-2xl font-semibold mb-4">Détails du Contrat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block mb-1 font-semibold">Type de Contrat</label>
                    <select name="type_contrat" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="CDD">CDD</option>
                        <option value="CDI">CDI</option>
                        <option value="Stage">Stage</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Date de Début</label>
                    <input type="date" name="date_debut" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Date de Fin</label>
                    <input type="date" name="date_fin" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Nombre de séances</label>
                    <input type="number" name="nb_seances" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Durée par séance (heures)</label>
                    <input type="number" step="0.1" name="duree_seance" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Ville URSSAF</label>
                    <input type="text" name="ville_urssaf" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Thème de l'atelier</label>
                    <input type="text" name="theme_atelier" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Lieu d'intervention</label>
                    <input type="text" name="lieu_intervention" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Classe concernée</label>
                    <input type="text" name="classe_concernee" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Nom de l'enseignant</label>
                    <input type="text" name="nom_enseignant" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Niveau scolaire</label>
                    <input type="text" name="niveau_scolaire" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Nombre d'élèves</label>
                    <input type="number" name="nombre_eleves" class="w-full p-3 rounded bg-[#2E3458] text-white">
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold">Dates et heures des séances</label>
                    <textarea name="dates_heures_seances" class="w-full p-3 rounded bg-[#2E3458] text-white" rows="3"></textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('rh.contrats.index') }}" class="mr-4 text-[#FBD9FA] underline hover:text-white">Annuler</a>
                <button type="submit" class="bg-[#AC72A1] text-[#070E2A] px-6 py-2 rounded-xl font-semibold hover:bg-[#FBD9FA] transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
