@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#4C4F73] text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Modifier la facture</h1>

    <form action="{{ route('factures.update', $facture->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Titre</label>
            <input type="text" name="titre" value="{{ $facture->titre }}" class="w-full text-black p-2 rounded" required>
        </div>

        <div>
            <label>Montant</label>
            <input type="number" name="montant" value="{{ $facture->montant }}" class="w-full text-black p-2 rounded" step="0.01" required>
        </div>

        <div>
            <label>Date d'échéance</label>
            <input type="date" name="date_echeance" value="{{ $facture->date_echeance }}" class="w-full text-black p-2 rounded" required>
        </div>

        <div>
            <label>Statut</label>
            <select name="statut" class="w-full text-black p-2 rounded">
                <option value="en attente" {{ $facture->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="relancée" {{ $facture->statut == 'relancée' ? 'selected' : '' }}>Relancée</option>
                <option value="payée" {{ $facture->statut == 'payée' ? 'selected' : '' }}>Payée</option>
            </select>
        </div>

        <button type="submit" class="bg-[#9C76B9] px-4 py-2 rounded hover:bg-[#B186C1]">Mettre à jour</button>
    </form>
</div>
@endsection
