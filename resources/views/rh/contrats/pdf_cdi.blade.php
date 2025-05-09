<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { width: 120px; margin-bottom: 10px; }
        h1 { color: #AC72A1; margin-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .article { margin-bottom: 15px; }
        .signature { 
            margin-top: 60px; 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start;
            width: 100%;
        }
        .signature div { 
            width: 45%; 
            text-align: center;
            display: inline-block;
            vertical-align: top;
        }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 8px 12px; }
        .info-table tr:nth-child(even) { background: #f3e6f7; }
        .mentions { font-size: 11px; color: #888; margin-top: 40px; text-align: center; border-top:1px solid #eee; padding-top:10px;}
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo Entreprise">
        <h1>Contrat à Durée Indéterminée (CDI)</h1>
    </div>

    <div class="section">
        Ce contrat est conclu entre l'employeur <span class="bold">webcinq</span>
        et l'employé <span class="bold">{{ $contrat->employe ?? 'N/A' }}</span>.
    </div>

    <div class="section">
        <table class="info-table">
            <tr><td><strong>Type de contrat :</strong></td><td>{{ $contrat->type ?? 'N/A' }}</td></tr>
            <tr><td><strong>Date de début :</strong></td><td>{{ $contrat->date_debut ?? 'N/A' }}</td></tr>
            @if($contrat->date_fin)
            <tr><td><strong>Date de fin :</strong></td><td>{{ $contrat->date_fin }}</td></tr>
            @endif
            <tr><td><strong>Salaire :</strong></td><td>{{ $contrat->salaire ?? 'N/A' }} DH</td></tr>
            <tr><td><strong>Statut :</strong></td><td>{{ $contrat->statut ?? 'N/A' }}</td></tr>
        </table>
    </div>

    <div class="article">
        <span class="bold">Article 1 :</span><br>
        L'employé <span class="bold">{{ $contrat->employe ?? 'N/A' }}</span> exercera ses fonctions au sein de l'entreprise <span class="bold">webcinq</span>.
    </div>
    <div class="article">
        <span class="bold">Article 2 :</span><br>
        Le présent contrat est conclu pour une durée {{ $contrat->type == 'CDI' ? 'indéterminée' : 'déterminée' }} à compter du {{ $contrat->date_debut ?? 'N/A' }}.
        @if($contrat->date_fin)
            Il prendra fin le {{ $contrat->date_fin }}.
        @endif
    </div>
    <div class="article">
        <span class="bold">Article 3 :</span><br>
        L'employé s'engage à respecter le règlement intérieur de l'entreprise et à accomplir les tâches qui lui sont confiées avec professionnalisme.
    </div>
    <div class="article">
        <span class="bold">Article 4 :</span><br>
        Le salaire mensuel brut est fixé à <span class="bold">{{ $contrat->salaire ?? 'N/A' }} DH</span>.
    </div>
    <div class="article">
        <span class="bold">Article 5 :</span><br>
        En cas de non-respect par l'une ou l'autre des parties de ses obligations, le contrat pourra être résilié selon les dispositions légales en vigueur.
    </div>

    <div class="section">
        Fait à <span class="bold">Marrakech</span> le <span class="bold">{{ \Carbon\Carbon::parse($contrat->date_debut)->subDays(2)->format('d/m/Y') }}</span>
    </div>

    <div class="signature">
        <div>
            <span class="bold">L'employeur</span><br>
            webcinq
        </div>
        <div>
            <span class="bold">L'employé</span><br>
            {{ $contrat->employe ?? 'N/A' }}
        </div>
    </div>

</body>
</html>