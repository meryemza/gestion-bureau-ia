<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 30px; }
        h1 { color: #AC72A1; margin-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 8px 12px; }
        .info-table tr:nth-child(even) { background: #f3e6f7; }
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
        .mentions { font-size: 11px; color: #888; margin-top: 40px; text-align: center; border-top:1px solid #eee; padding-top:10px;}
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Convention de Stage</h1>
    </div>

    <div class="section">
        Cette convention est conclue entre l'entreprise <span class="bold">webcinq</span>
        et le stagiaire <span class="bold">{{ $contrat->employe ?? 'N/A' }}</span>.
    </div>

    <div class="section">
        <table class="info-table">
            <tr><td><strong>Type de contrat :</strong></td><td>{{ $contrat->type ?? 'N/A' }}</td></tr>
            <tr><td><strong>Date de début :</strong></td><td>{{ $contrat->date_debut ?? 'N/A' }}</td></tr>
            <tr><td><strong>Date de fin :</strong></td><td>{{ $contrat->date_fin ?? 'N/A' }}</td></tr>
            <tr><td><strong>Gratification :</strong></td><td>{{ $contrat->salaire ?? 'Non rémunéré' }} DH</td></tr>
            <tr><td><strong>Statut :</strong></td><td>{{ $contrat->statut ?? 'N/A' }}</td></tr>
        </table>
    </div>

    <div class="article">
        <span class="bold">Article 1 :</span><br>
        Le stagiaire <span class="bold">{{ $contrat->employe ?? 'N/A' }}</span> exercera ses fonctions au sein de l'entreprise <span class="bold">webcinq</span>.
    </div>
    <div class="article">
        <span class="bold">Article 2 :</span><br>
        La présente convention de stage est conclue pour la période du {{ $contrat->date_debut ?? 'N/A' }} au {{ $contrat->date_fin ?? 'N/A' }}.
    </div>
    <div class="article">
        <span class="bold">Article 3 :</span><br>
        Le stagiaire s'engage à respecter le règlement intérieur de l'entreprise et à accomplir les tâches qui lui sont confiées avec sérieux.
    </div>
    <div class="article">
        <span class="bold">Article 4 :</span><br>
        La gratification mensuelle est fixée à <span class="bold">{{ $contrat->salaire ?? 'Non rémunéré' }} DH</span>.
    </div>
    <div class="article">
        <span class="bold">Article 5 :</span><br>
        En cas de non-respect par l'une ou l'autre des parties de ses obligations, la convention pourra être résiliée selon les dispositions légales en vigueur.
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
            <span class="bold">Le stagiaire</span><br>
            {{ $contrat->employe ?? 'N/A' }}
        </div>
    </div>

    <div class="mentions">
        <strong>Mentions légales :</strong><br>
        Ce contrat est soumis au droit du travail en vigueur.<br>
        Toute modification devra faire l'objet d'un avenant signé par les deux parties.<br>
        Les informations personnelles sont traitées conformément à la législation sur la protection des données.
    </div>
</body>
</html>
