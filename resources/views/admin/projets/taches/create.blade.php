@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 p-6 bg-white dark:bg-gray-900 shadow rounded-lg dark:text-white">
    <h2 class="text-2xl font-bold mb-6">Ajouter une tâche au projet : {{ $projet->titre }}</h2>

    <form action="{{ route('taches.store', ['projet' => $projet->id]) }}" method="POST">


        @csrf
        <input type="hidden" name="projet_id" value="{{ $projet->id }}">

        {{-- Titre --}}
        <div class="mb-4">
            <label for="titre" class="block font-semibold mb-1">Titre</label>
            <input type="text" name="titre" id="titre" class="w-full border rounded px-3 py-2 dark:bg-gray-800" required>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2 dark:bg-gray-800" required></textarea>
        </div>

        {{-- Statut --}}
        <div class="mb-4">
            <label for="statut" class="block font-semibold mb-1">Statut</label>
            <select name="statut" id="statut" class="w-full border rounded px-3 py-2 dark:bg-gray-800" required>
                <option value="en_attente">En attente</option>
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminée</option>
            </select>
        </div>

        {{-- Priorité --}}
        <div class="mb-6">
            <label for="priorite" class="block font-semibold mb-1">Priorité</label>
            <select name="priorite" id="priorite" class="w-full border rounded px-3 py-2 dark:bg-gray-800" required>
            <option value="basse">Basse</option>
    <option value="moyenne">Moyenne</option>
    <option value="haute">Haute</option>
            </select>
        </div>

        {{-- Bouton enregistrer --}}
        <div class="flex justify-between">
            <a href="{{ route('projets.taches.index', $projet->id) }}" class="text-purple-600 hover:underline">← Retour</a>
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">Ajouter</button>
        </div>
    </form>
</div>
@endsection
