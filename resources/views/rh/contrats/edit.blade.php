@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white min-h-screen p-10">
    <div class="max-w-3xl mx-auto bg-[#1A1F3B] p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6">Modifier le Contrat</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rh.contrats.update', $contrat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nom de l’employé</label>
                <input type="text" name="employe" value="{{ $contrat->employe }}" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Type de Contrat</label>
                <select name="type" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                    <option value="CDI" {{ $contrat->type == 'CDI' ? 'selected' : '' }}>CDI</option>
                    <option value="CDD" {{ $contrat->type == 'CDD' ? 'selected' : '' }}>CDD</option>
                    <option value="Stage" {{ $contrat->type == 'Stage' ? 'selected' : '' }}>Stage</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Date de Début</label>
                <input type="date" name="date_debut" value="{{ $contrat->date_debut }}" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Date de Fin</label>
                <input type="date" name="date_fin" value="{{ $contrat->date_fin }}" class="w-full p-3 rounded bg-[#2E3458] text-white">
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-semibold">Statut</label>
                <select name="statut" class="w-full p-3 rounded bg-[#2E3458] text-white" required>
                    <option value="Actif" {{ $contrat->statut == 'Actif' ? 'selected' : '' }}>Actif</option>
                    <option value="En cours" {{ $contrat->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Terminé" {{ $contrat->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('rh.contrats.index') }}" class="mr-4 text-[#FBD9FA] underline hover:text-white">Annuler</a>
                <button type="submit" class="bg-[#AC72A1] text-[#070E2A] px-6 py-2 rounded-xl font-semibold hover:bg-[#FBD9FA] transition">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
