@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white min-h-screen p-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Gestion des Contrats</h1>
        <a href="{{ route('rh.contrats.create') }}" class="bg-[#AC72A1] text-[#070E2A] font-semibold px-4 py-2 rounded-xl shadow hover:bg-[#FBD9FA] transition">
            + Ajouter un Contrat
        </a>
    </div>

    <div class="bg-[#1A1F3B] rounded-2xl shadow-lg p-6 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left text-[#FBD9FA] border-b border-[#AC72A1]">
                    <th class="py-3 px-4">Employé</th>
                    <th class="py-3 px-4">Type</th>
                    <th class="py-3 px-4">Date de début</th>
                    <th class="py-3 px-4">Date de fin</th>
                    <th class="py-3 px-4">Statut</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contrats as $contrat)
                    <tr class="border-b border-[#2E3458] hover:bg-[#2E3458] transition">
                        <td class="py-3 px-4">{{ $contrat->employe }}</td>
                        <td class="py-3 px-4">{{ $contrat->type }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($contrat->date_debut)->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            {{ $contrat->date_fin ? \Carbon\Carbon::parse($contrat->date_fin)->format('d M Y') : '-' }}
                        </td>
                        <td class="py-3 px-4">
                            @if ($contrat->statut == 'Actif')
                                <span class="text-green-400">{{ $contrat->statut }}</span>
                            @elseif ($contrat->statut == 'En cours')
                                <span class="text-yellow-400">{{ $contrat->statut }}</span>
                            @else
                                <span class="text-red-400">{{ $contrat->statut }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 space-x-3">
                            <a href="{{ route('rh.contrats.edit', $contrat->id) }}" class="text-blue-400 hover:underline">Modifier</a>

                            <form action="{{ route('rh.contrats.destroy', $contrat->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Confirmer la suppression ?')" class="text-red-500 hover:underline">
                                    Supprimer
                                </button>
                            </form>

                            <a href="{{ route('rh.contrats.pdf', $contrat->id) }}" class="text-purple-400 hover:underline">PDF</a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Aucun contrat trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

