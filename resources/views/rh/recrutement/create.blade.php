@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <!-- Titre principal -->
    <h1 class="text-3xl font-bold mb-6 text-center">Nouveau Recrutement</h1>

    <!-- Message de succès -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Message d'erreur -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-600 text-white rounded shadow">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de recrutement -->
    <form action="{{ route('rh.recrutement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6 max-w-xl mx-auto">
            <div>
                <label class="block text-sm mb-2">Nom du candidat</label>
                <input type="text" name="nom" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm mb-2">Poste souhaité</label>
                <input type="text" name="poste" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm mb-2">Email</label>
                <input type="email" name="email" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm mb-2">CV (PDF)</label>
                <input type="file" name="cv" accept="application/pdf" class="w-full p-2 bg-[#1A1F3B] text-white rounded-lg" required>
            </div>
        </div>

        <!-- Bouton d'enregistrement -->
        <div class="mt-6 flex justify-center">
            <button type="submit" class="bg-[#AC72A1] hover:bg-[#FBD9FA] text-[#070E2A] font-semibold px-6 py-3 rounded-lg">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection