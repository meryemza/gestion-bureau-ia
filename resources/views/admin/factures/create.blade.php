@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#4C4F73] text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-4">Ajouter une facture</h1>

    <form action="{{ route('factures.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="text-black w-full p-2 rounded">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="text-black w-full p-2 rounded" required>
        </div>

        <div>
            <label for="montant">Montant</label>
            <input type="number" step="0.01" name="montant" id="montant" class="text-black w-full p-2 rounded" required>
        </div>

        <div>
            <label for="date_echeance">Date d’échéance</label>
            <input type="date" name="date_echeance" id="date_echeance" class="text-black w-full p-2 rounded">
        </div>

        <div>
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="text-black w-full p-2 rounded">
                <option value="en attente">En attente</option>
                <option value="payée">Payée</option>
                <option value="relancée">Relancée</option>
            </select>
        </div>

        <button type="submit" class="bg-[#9C76B9] px-4 py-2 rounded hover:bg-[#B186C1]">Ajouter</button>
    </form>
</div>
@endsection

