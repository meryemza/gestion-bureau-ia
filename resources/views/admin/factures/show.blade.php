@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#4C4F73] text-white min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Détails de la facture</h1>

    <div class="bg-[#5D6C91] p-4 rounded-xl shadow-md">
        <p><strong>Client :</strong> {{ $facture->client->nom ?? 'Client supprimé' }}</p>
        <p><strong>Titre :</strong> {{ $facture->titre }}</p>
        <p><strong>Montant :</strong> {{ number_format($facture->montant, 2) }} DH</p>
        <p><strong>Échéance :</strong> {{ $facture->date_echeance ?? '-' }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($facture->statut) }}</p>
    </div>
    <div class="mt-6 flex justify-between items-center">
    <a href="{{ route('factures.exportPDF', $facture->id) }}" class="bg-[#9C76B9] px-4 py-2 rounded hover:bg-[#B186C1] text-white">
        Exporter en PDF
    </a>

    <a href="{{ route('factures.index') }}" class="text-white underline">
        ← Retour
    </a>
</div>

</div>
@endsection

