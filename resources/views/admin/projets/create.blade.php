@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h2 class="text-3xl font-bold mb-6">Ajouter un Projet</h2>
    
    <form action="{{ route('admin.projets.store') }}" method="POST" class="bg-[#1A1F3B] p-6 rounded-xl shadow-lg">
        @csrf

        <!-- Nom du projet -->
        <div class="mb-4">
            <label for="nom" class="block text-lg font-medium mb-2">Nom du projet</label>
            <input type="text" name="nom" class="w-full p-3 bg-[#2A2E45] text-white rounded-md border border-[#3B4357]" required>
            @error('nom')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-lg font-medium mb-2">Description</label>
            <textarea name="description" class="w-full p-3 bg-[#2A2E45] text-white rounded-md border border-[#3B4357]" required></textarea>
            @error('description')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Statut -->
        <div class="mb-4">
            <label for="statut" class="block text-lg font-medium mb-2">Statut</label>
            <select name="statut" class="w-full p-3 bg-[#2A2E45] text-white rounded-md border border-[#3B4357]" required>
                <option value="en_cours" class="bg-[#2A2E45]" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="termine" class="bg-[#2A2E45]" {{ old('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                <option value="en_attente" class="bg-[#2A2E45]" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
            </select>
            @error('statut')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date de début -->
        <div class="mb-4">
            <label for="date_debut" class="block text-lg font-medium mb-2">Date de début</label>
            <input type="date" name="date_debut" class="w-full p-3 bg-[#2A2E45] text-white rounded-md border border-[#3B4357]" required>
            @error('date_debut')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date de fin -->
        <div class="mb-4">
            <label for="date_fin" class="block text-lg font-medium mb-2">Date de fin</label>
            <input type="date" name="date_fin" class="w-full p-3 bg-[#2A2E45] text-white rounded-md border border-[#3B4357]" required>
            @error('date_fin')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sélection des employés -->
         <!-- Sélection des employés -->
         <div class="mb-4">
            <label class="block text-lg font-medium mb-2">Sélectionner les employés</label>
            <div class="space-y-2">
                @foreach ($employes as $employe)
                    <label class="inline-flex items-center text-white">
                        <input type="checkbox" name="employes[]" value="{{ $employe->id }}" class="form-checkbox text-[#AC72A1]">
                        <span class="ml-2">{{ $employe->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('employes')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="w-full py-3 bg-[#AC72A1] text-white rounded-md hover:bg-[#C08D9D] transition duration-200">Ajouter</button>
        
        <!-- Lien d'annulation -->
        <a href="{{ route('admin.projets') }}" class="block text-center mt-4 text-[#A0A7B3] hover:text-white">Annuler</a>
    </form>
</div>
@endsection
