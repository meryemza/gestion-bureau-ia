@extends('layouts.app')

@section('content')
<div class="p-6 text-white bg-[#070E2A] min-h-screen">
    <h2 class="text-2xl font-bold mb-6">Statut de mes demandes</h2>

    <div class="bg-[#1A1F3B] p-4 rounded-xl shadow-lg">
        <table class="w-full table-auto">
            <thead class="bg-[#AC72A1] text-white">
                <tr>
                    <th class="px-4 py-2">Date Début</th>
                    <th class="px-4 py-2">Date Fin</th>
                    <th class="px-4 py-2">Motif</th>
                    <th class="px-4 py-2">Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($conges as $conge)
                    <tr class="border-t border-gray-600 hover:bg-[#2a2e45]">
                        <td class="px-4 py-2">{{ $conge->date_debut }}</td>
                        <td class="px-4 py-2">{{ $conge->date_fin }}</td>
                        <td class="px-4 py-2">{{ $conge->motif }}</td>
                        <td class="px-4 py-2">
                            @if ($conge->statut == 'Accepté')
                                <span class="text-green-400 font-semibold">Accepté</span>
                            @elseif ($conge->statut == 'Refusé')
                                <span class="text-red-400 font-semibold">Refusé</span>
                            @else
                                <span class="text-yellow-400 font-semibold">En attente</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-400 py-4">Aucune demande de congé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
