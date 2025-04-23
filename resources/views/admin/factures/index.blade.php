@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#4C4F73] text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-4">Liste des factures</h1>

    <a href="{{ route('factures.create') }}" class="bg-[#9C76B9] px-4 py-2 rounded hover:bg-[#B186C1]">
        Ajouter une facture
    </a>

    @if(session('success'))
        <div class="mt-4 p-3 bg-green-600 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($factures->count())
        <table class="w-full mt-6 bg-[#5D6C91] rounded-xl shadow-lg text-white">
            <thead>
                <tr>
                    <th class="p-3 text-left">Client</th>
                    <th class="p-3 text-left">Titre</th>
                    <th class="p-3 text-left">Montant</th>
                    <th class="p-3 text-left">Échéance</th>
                    <th class="p-3 text-left">Statut</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factures as $facture)
                <tr class="border-t border-[#6D7B99]">
                    <td class="p-3">{{ $facture->client->nom ?? 'Client supprimé' }}</td>
                    <td class="p-3">{{ $facture->titre }}</td>
                    <td class="p-3">{{ number_format($facture->montant, 2) }} DH</td>
                    <td class="p-3">{{ $facture->date_echeance ?? '-' }}</td>
                    <td class="p-3">{{ ucfirst($facture->statut) }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('factures.show', $facture->id) }}" class="text-blue-300 hover:underline">Voir</a>
                        <a href="{{ route('factures.edit', $facture->id) }}" class="text-yellow-300 hover:underline">Modifier</a>
                        <form action="{{ route('factures.destroy', $facture->id) }}" method="POST" onsubmit="return confirm('Supprimer cette facture ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-6 text-gray-300">Aucune facture trouvée.</p>
    @endif
</div>
@endsection
