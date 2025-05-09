@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Modifier le Candidat</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-600 text-white rounded shadow">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('rh.recrutement.update', $recrutement) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm mb-2">Nom du candidat</label>
            <input type="text" name="nom" value="{{ old('nom', $recrutement->nom) }}" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
        </div>
        <div>
            <label class="block text-sm mb-2">Poste souhaité</label>
            <input type="text" name="poste" value="{{ old('poste', $recrutement->poste) }}" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
        </div>
        <div>
            <label class="block text-sm mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $recrutement->email) }}" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
        </div>
        <div>
            <label class="block text-sm mb-2">CV (PDF, laisser vide pour ne pas changer)</label>
            <input type="file" name="cv" accept="application/pdf" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg">
        </div>
        <div class="mt-6 flex justify-center">
            <button type="submit" class="bg-[#AC72A1] hover:bg-[#FBD9FA] text-[#070E2A] font-semibold px-6 py-3 rounded-lg">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
