@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier la tâche</h2>

    <form action="{{ route('taches.update', $tache->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $tache->titre) }}"
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            @error('titre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('description', $tache->description) }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="statut" id="statut"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="en_attente" {{ $tache->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="en_cours" {{ $tache->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="terminee" {{ $tache->statut == 'terminee' ? 'selected' : '' }}>Terminée</option>
            </select>
            @error('statut')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="priorite" class="block text-sm font-medium text-gray-700">Priorité</label>
            <select name="priorite" id="priorite"
                    class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="0" {{ $tache->priorite == 0 ? 'selected' : '' }}>Basse</option>
                <option value="1" {{ $tache->priorite == 1 ? 'selected' : '' }}>Moyenne</option>
                <option value="2" {{ $tache->priorite == 2 ? 'selected' : '' }}>Haute</option>
            </select>
            @error('priorite')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('projets.taches.index', $tache->projet_id) }}"
               class="text-gray-600 hover:underline">← Retour</a>

            <button type="submit"
                    class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition duration-200">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
