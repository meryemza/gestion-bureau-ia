
<!-- Informations sur l'employeur -->
<h2 class="text-2xl font-semibold mb-4">Informations sur l'Employeur</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label class="block mb-1 font-semibold">Nom de la structure</label>
        <input type="text" name="employeur_nom" value="webcinq" class="w-full p-3 rounded bg-[#2E3458] text-white" readonly>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Représentant légal</label>
        <input type="text" name="employeur_representant" value="{{ old('employeur_representant', $contrat->employeur_representant ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Fonction</label>
        <input type="text" name="employeur_fonction" value="{{ old('employeur_fonction', $contrat->employeur_fonction ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Code APE</label>
        <input type="text" name="employeur_code_ape" value="{{ old('employeur_code_ape', $contrat->employeur_code_ape ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Numéro SIRET</label>
        <input type="text" name="employeur_siret" value="{{ old('employeur_siret', $contrat->employeur_siret ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Adresse</label>
        <input type="text" name="employeur_adresse" value="{{ old('employeur_adresse', $contrat->employeur_adresse ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
</div>

<!-- Informations sur l'employé -->
<h2 class="text-2xl font-semibold mb-4">Informations sur l'Employé</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label class="block mb-1 font-semibold">Civilité</label>
        <select name="employe_civilite" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
            <option value="">-- Sélectionner --</option>
            <option value="Mme" {{ old('employe_civilite', $contrat->employe_civilite ?? '') == 'Mme' ? 'selected' : '' }}>Mme</option>
            <option value="M." {{ old('employe_civilite', $contrat->employe_civilite ?? '') == 'M.' ? 'selected' : '' }}>M.</option>
        </select>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Nom</label>
        <input type="text" name="employe_nom" value="{{ old('employe_nom', $contrat->employe_nom ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Prénom</label>
        <input type="text" name="employe_prenom" value="{{ old('employe_prenom', $contrat->employe_prenom ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Nationalité</label>
        <input type="text" name="employe_nationalite" value="{{ old('employe_nationalite', $contrat->employe_nationalite ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Date de naissance</label>
        <input type="date" name="employe_date_naissance" value="{{ old('employe_date_naissance', $contrat->employe_date_naissance ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Lieu de naissance</label>
        <input type="text" name="employe_lieu_naissance" value="{{ old('employe_lieu_naissance', $contrat->employe_lieu_naissance ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Adresse</label>
        <input type="text" name="employe_adresse" value="{{ old('employe_adresse', $contrat->employe_adresse ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Numéro de sécurité sociale</label>
        <input type="text" name="employe_num_securite_sociale" value="{{ old('employe_num_securite_sociale', $contrat->employe_num_securite_sociale ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Numéro d'affiliation Agessa</label>
        <input type="text" name="employe_num_agessa" value="{{ old('employe_num_agessa', $contrat->employe_num_agessa ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
</div>

<!-- Détails du contrat -->
<h2 class="text-2xl font-semibold mb-4">Détails du Contrat</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label class="block mb-1 font-semibold">Type de Contrat</label>
        <select name="type_contrat" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
            <option value="">-- Sélectionner --</option>
            <option value="CDD" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'CDD' ? 'selected' : '' }}>CDD</option>
            <option value="CDI" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'CDI' ? 'selected' : '' }}>CDI</option>
            <option value="Stage" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'Stage' ? 'selected' : '' }}>Stage</option>
        </select>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Date de Début</label>
        <input type="date" name="date_debut" value="{{ old('date_debut', $contrat->date_debut ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Date de Fin</label>
        <input type="date" name="date_fin" value="{{ old('date_fin', $contrat->date_fin ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Nombre de séances</label>
        <input type="number" name="nb_seances" value="{{ old('nb_seances', $contrat->nb_seances ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Durée par séance (heures)</label>
        <input type="number" step="0.1" name="duree_seance" value="{{ old('duree_seance', $contrat->duree_seance ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Ville URSSAF</label>
        <input type="text" name="ville_urssaf" value="{{ old('ville_urssaf', $contrat->ville_urssaf ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Thème de l'atelier</label>
        <input type="text" name="theme_atelier" value="{{ old('theme_atelier', $contrat->theme_atelier ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Lieu d'intervention</label>
        <input type="text" name="lieu_intervention" value="{{ old('lieu_intervention', $contrat->lieu_intervention ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Classe concernée</label>
        <input type="text" name="classe_concernee" value="{{ old('classe_concernee', $contrat->classe_concernee ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Nom de l'enseignant</label>
        <input type="text" name="nom_enseignant" value="{{ old('nom_enseignant', $contrat->nom_enseignant ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Niveau scolaire</label>
        <input type="text" name="niveau_scolaire" value="{{ old('niveau_scolaire', $contrat->niveau_scolaire ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div>
        <label class="block mb-1 font-semibold">Nombre d'élèves</label>
        <input type="number" name="nombre_eleves" value="{{ old('nombre_eleves', $contrat->nombre_eleves ?? '') }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
    </div>
    <div class="md:col-span-2">
        <label class="block mb-1 font-semibold">Dates et heures des séances</label>
        <textarea name="dates_heures_seances" class="w-full p-3 rounded bg-[#2E3458] text-white" rows="3">{{ old('dates_heures_seances', $contrat->dates_heures_seances ?? '') }}</textarea>
    </div>
    <div class="mb-4">
        <label for="salaire" class="block text-sm font-medium text-gray-200">Salaire (DH)</label>
        <input type="number" step="0.01" name="salaire" id="salaire" value="{{ old('salaire', $contrat->salaire ?? '') }}" class="mt-1 block w-full rounded-md bg-[#1A1F3B] text-white border-2 border-[#AC72A1] focus:border-[#FBD9FA] transition" required>
    </div>
</div>
