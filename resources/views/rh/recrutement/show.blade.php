@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Détail du Candidat</h1>
    <div class="max-w-xl mx-auto bg-[#1A1F3B] p-6 rounded-lg">
        <p><strong>Nom :</strong> {{ $recrutement->nom }}</p>
        <p><strong>Poste :</strong> {{ $recrutement->poste }}</p>
        <p><strong>Email :</strong> {{ $recrutement->email }}</p>
        <p><strong>CV :</strong> <a href="{{ asset('storage/' . $recrutement->cv) }}" target="_blank" class="underline">Voir le CV</a></p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('rh.recrutement.edit', $recrutement) }}" class="text-yellow-400">Éditer</a>
            <a href="{{ route('rh.recrutement.index') }}" class="text-blue-400">Retour</a>
        </div>
    </div>
</div>
@endsection
