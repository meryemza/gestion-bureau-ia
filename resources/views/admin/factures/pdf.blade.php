<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $facture->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #2C3E50;
            font-size: 14px;
            margin: 0;
            padding: 40px;
            background-color: #fff;
        }

        .header, .footer {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
            color: #4C4F73;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 6px;
            margin-bottom: 10px;
            color: #34495E;
        }

        .info, .facture-details {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #e1e1e1;
        }

        .info p, .facture-details p {
            margin: 6px 0;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #27AE60;
            margin-top: 20px;
            text-align: right;
        }

        .footer {
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>FACTURE</h2>
        <p>Numéro : <strong>#{{ $facture->id }}</strong></p>
        <p>Date : {{ \Carbon\Carbon::parse($facture->created_at)->format('d/m/Y') }}</p>
    </div>

    <div class="section info">
        <div class="section-title">Informations du client</div>
        <p><span class="label">Nom :</span> {{ $facture->client->nom }}</p>
        <p><span class="label">Email :</span> {{ $facture->client->email }}</p>
    </div>

    <div class="section facture-details">
        <div class="section-title">Détails de la facture</div>
        <p><span class="label">Titre :</span> {{ $facture->titre }}</p>
        <p><span class="label">Montant :</span> {{ number_format($facture->montant, 2) }} DH</p>
        <p><span class="label">Date d’échéance :</span> {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}</p>
        <p><span class="label">Statut :</span> {{ ucfirst($facture->statut) }}</p>
        <div class="total">Total à payer : {{ number_format($facture->montant, 2) }} DH</div>
    </div>

    <div class="footer">
        <p>Merci pour votre confiance.</p>
    </div>

</body>
</html>
