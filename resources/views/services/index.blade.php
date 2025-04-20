@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Liste des services</h1>

    {{-- Bouton Ajouter un service --}}
    <a href="{{ route('services.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-6">
        + Ajouter un service
    </a>

    @if ($services->isEmpty())
        <p class="text-gray-400">Aucun service enregistré.</p>
    @else
        <table class="min-w-full table-auto text-left bg-[#1A1F3B] rounded-xl overflow-hidden">
            <thead class="bg-[#AC72A1] text-white">
                <tr>
                    <th class="px-4 py-2">Nom du service</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Prix</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr class="border-t border-gray-600 hover:bg-[#2a2e45]">
                        <td class="px-4 py-2">{{ $service->nom }}</td>
                        <td class="px-4 py-2">{{ $service->description }}</td>
                        <td class="px-4 py-2">{{ number_format($service->prix_ttc, 2) }} MAD</td>

                        <td class="px-4 py-2 flex space-x-2">
                            {{-- Bouton Modifier --}}
                            <a href="{{ route('services.edit', $service->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-4 rounded">
                                Modifier
                            </a>

                            {{-- Bouton Supprimer --}}
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

