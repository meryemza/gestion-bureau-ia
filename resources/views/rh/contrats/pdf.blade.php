<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat de travail</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    {{-- TITRE DYNAMIQUE --}}
    <div class="header">
        @switch($contrat->type_contrat)
            @case('CDD')
                <h1>CONTRAT DE TRAVAIL À DURÉE DÉTERMINÉE (CDD)</h1>
                @break
            @case('CDI')
                <h1>CONTRAT DE TRAVAIL À DURÉE INDÉTERMINÉE (CDI)</h1>
                @break
            @case('Stage')
                <h1>CONVENTION DE STAGE</h1>
                @break
            @default
                <h1>CONTRAT DE TRAVAIL</h1>
        @endswitch
    </div>

    {{-- INFORMATIONS DE BASE --}}
    <p>Ce contrat est conclu entre :</p>
    <p><strong>Employeur :</strong> {{ $contrat->employeur->nom }} - {{ $contrat->employeur->adresse }}</p>
    <p><strong>Employé(e) :</strong> {{ $contrat->employe->civilite }} {{ $contrat->employe->nom }} {{ $contrat->employe->prenom }}</p>

    {{-- ARTICLE 1 --}}
    <p class="section-title">ARTICLE 1 - Engagement</p>
    @switch($contrat->type_contrat)
        @case('CDD')
            <p>{{ $contrat->employe->civilite }} est engagé(e) selon un contrat à durée déterminée, en qualité de <strong>{{ $contrat->poste }}</strong> pour la période allant du <strong>{{ $contrat->date_debut }}</strong> au <strong>{{ $contrat->date_fin }}</strong>.</p>
            @break
        @case('CDI')
            <p>{{ $contrat->employe->civilite }} est engagé(e) selon un contrat à durée indéterminée, en qualité de <strong>{{ $contrat->poste }}</strong> à compter du <strong>{{ $contrat->date_debut }}</strong>.</p>
            @break
        @case('Stage')
            <p>{{ $contrat->employe->civilite }} effectue un stage en qualité de <strong>{{ $contrat->poste }}</strong> du <strong>{{ $contrat->date_debut }}</strong> au <strong>{{ $contrat->date_fin }}</strong>, dans le cadre de sa formation.</p>
            @break
        @default
            <p>Contrat de travail en qualité de <strong>{{ $contrat->poste }}</strong>.</p>
    @endswitch

    {{-- ARTICLE 2 --}}
    <p class="section-title">ARTICLE 2 - Rémunération</p>
    @if($contrat->type_contrat == 'Stage')
        <p>Le stagiaire percevra une gratification mensuelle de <strong>{{ $contrat->salaire }} €</strong>.</p>
    @else
        <p>Le salarié percevra une rémunération mensuelle brute de <strong>{{ $contrat->salaire }} €</strong>.</p>
    @endif

    {{-- ARTICLE 3 --}}
    <p class="section-title">ARTICLE 3 - Horaires de travail</p>
    <p>Les horaires de travail sont fixés de <strong>{{ $contrat->horaire_debut }}</strong> à <strong>{{ $contrat->horaire_fin }}</strong>, du lundi au vendredi.</p>

    {{-- ARTICLE 4 --}}
    <p class="section-title">ARTICLE 4 - Lieu de travail</p>
    <p>Le travail sera effectué à l’adresse suivante : <strong>{{ $contrat->lieu_travail }}</strong>.</p>

    {{-- ARTICLE 5 --}}
    <p class="section-title">ARTICLE 5 - Obligations</p>
    <p>Le salarié/stagiaire s’engage à respecter le règlement intérieur et les consignes de sécurité en vigueur.</p>

    {{-- SIGNATURES --}}
    <div class="footer">
        <p>Fait à {{ $contrat->lieu_signature }}, le {{ $contrat->date_signature }}</p>
        <p>Signature de l’employeur : _________________________</p>
        <p>Signature du salarié/stagiaire : ____________________</p>
    </div>
</body>
</html>
