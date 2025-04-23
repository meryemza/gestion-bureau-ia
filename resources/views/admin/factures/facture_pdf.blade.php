<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $facture->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 30px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            color: #4C4F73;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .info p {
            margin: 2px 0;
        }
        .facture-details {
            background: #F5F5F5;
            padding: 15px;
            border-radius: 8px;
        }
        .facture-details p {
            margin: 5px 0;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            color: #2E7D32;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>FACTURE</h2>
        <p>Numéro : #{{ $facture->id }}</p>
        <p>Date : {{ \Carbon\Carbon::parse($facture->created_at)->format('d/m/Y') }}</p>
    </div>

    <div class="section info">
        <div class="section-title">Informations du client</div>
        <p><strong>Nom :</strong> {{ $facture->client->nom }}</p>
        <p><strong>Email :</strong> {{ $facture->client->email }}</p>
    </div>

    <div class="section facture-details">
        <div class="section-title">Détails de la facture</div>
        <p><strong>Titre :</strong> {{ $facture->titre }}</p>
        <p><strong>Montant :</strong> {{ number_format($facture->montant, 2) }} DH</p>
        <p><strong>Date d’échéance :</strong> {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($facture->statut) }}</p>
        <p class="total">Total à payer : {{ number_format($facture->montant, 2) }} DH</p>
    </div>

    <div class="footer">
        <p>Merci pour votre confiance.</p>
    </div>

</body>
</html>
