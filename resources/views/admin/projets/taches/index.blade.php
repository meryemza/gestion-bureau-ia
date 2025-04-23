@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg dark:bg-gray-900 dark:text-white">
    <h2 class="text-2xl font-semibold mb-6">✏️ Modifier la tâche</h2>

    <form action="{{ route('taches.update', $tache->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Titre --}}
        <div>
            <label class="block mb-1 font-medium">Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $tache->titre) }}"
                   class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
        </div>

        {{-- Description --}}
        <div>
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600">{{ old('description', $tache->description) }}</textarea>
        </div>

        {{-- Statut --}}
        <div>
            <label class="block mb-1 font-medium">Statut</label>
            <select name="statut"
                    class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                <option value="en_attente" {{ $tache->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="en_cours" {{ $tache->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="terminee" {{ $tache->statut == 'terminee' ? 'selected' : '' }}>Terminée</option>
            </select>
        </div>

        {{-- Priorité --}}
        <div>
            <label class="block mb-1 font-medium">Priorité</label>
            <select name="priorite"
                    class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                <option value="basse" {{ $tache->priorite == 'basse' ? 'selected' : '' }}>Basse</option>
                <option value="moyenne" {{ $tache->priorite == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                <option value="haute" {{ $tache->priorite == 'haute' ? 'selected' : '' }}>Haute</option>
            </select>
        </div>

        {{-- Bouton de soumission --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('projets.taches.index', ['projet' => $tache->projet_id]) }}"
               class="text-purple-500 hover:underline">← Retour aux tâches</a>

            <button type="submit"
                    class="px-6 py-2 bg-purple-700 text-white rounded hover:bg-purple-800 transition">
                💾 Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection

