<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; }
        h1 { color: #AC72A1; text-align: center; }
    </style>
</head>
<body>
    <h1>Contrat</h1>
    <p><strong>Type :</strong> {{ $contrat->type ?? 'N/A' }}</p>
    <p><strong>Employé :</strong> {{ $contrat->employe->name ?? 'N/A' }} {{ $contrat->employe->prenom ?? '' }}</p>
    <p><strong>Poste :</strong> {{ $contrat->poste ?? 'N/A' }}</p>
    <p><strong>Date de début :</strong> {{ $contrat->date_debut ?? 'N/A' }}</p>
    <p><strong>Date de fin :</strong> {{ $contrat->date_fin ?? 'N/A' }}</p>
    <p><strong>Salaire :</strong> {{ $contrat->salaire ?? 'N/A' }} DH</p>
    <p><strong>Avantages :</strong> {{ $contrat->avantages ?? 'N/A' }}</p>
    <p><strong>Employeur :</strong> webcinq</p>
</body>
</html>
