<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiche de paie</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>
    <h2>Fiche de paie - {{ $salaire->mois }}</h2>
    <p><strong>Employé :</strong> {{ $salaire->employe->name }}</p>
    <table>
        <tr><th>Salaire de base</th><td>{{ $salaire->salaire_base }} €</td></tr>
        <tr><th>Prime</th><td>{{ $salaire->prime }} €</td></tr>
        <tr><th>Déduction</th><td>{{ $salaire->deduction }} €</td></tr>
        <tr><th><strong>Salaire Net</strong></th><td><strong>{{ $salaire->salaire_net }} €</strong></td></tr>
        <tr><th>Date de paiement</th><td>{{ $salaire->date_paiement }}</td></tr>
    </table>
</body>
</html>
