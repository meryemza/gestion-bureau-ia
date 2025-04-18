@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Liste des projets</h1>

    {{-- Bouton Ajouter un projet --}}
    <a href="{{ route('admin.projets.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-6">
        + Ajouter un projet
    </a>

    @if ($projets->isEmpty())
        <p class="text-gray-400">Aucun projet enregistré.</p>
    @else
        <table class="min-w-full table-auto text-left bg-[#1A1F3B] rounded-xl overflow-hidden">
            <thead class="bg-[#AC72A1] text-white">
                <tr>
                    <th class="px-4 py-2">Nom du projet</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Date de début</th>
                    <th class="px-4 py-2">Date de fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projets as $projet)
                    <tr class="border-t border-gray-600 hover:bg-[#2a2e45]">
                        <td class="px-4 py-2">{{ $projet->nom }}</td>
                        <td class="px-4 py-2">{{ $projet->description }}</td>
                        <td class="px-4 py-2">
                            @if ($projet->statut == 'en_cours')
                                <span class="text-yellow-400 font-semibold">En cours</span>
                            @elseif ($projet->statut == 'termine')
                                <span class="text-green-400 font-semibold">Terminé</span>
                            @else
                                <span class="text-red-400 font-semibold">En attente</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $projet->date_debut }}</td>
                        <td class="px-4 py-2">{{ $projet->date_fin }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
