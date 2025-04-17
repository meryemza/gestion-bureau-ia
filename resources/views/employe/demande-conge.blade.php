@extends('layouts.app')

@section('content')
    <div class="bg-[#070E2A] text-white min-h-screen">
        <main class="flex-1 p-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Demande de Congé</h1>
            </div>

            <!-- Affichage du message de succès -->
            @if(session('success'))
                <div class="alert alert-success text-green-500 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <form action="{{ route('employe.conges.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="date_debut" class="block">Date de début</label>
                        <input type="date" id="date_debut" name="date_debut" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white" required>
                        @error('date_debut')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="date_fin" class="block">Date de fin</label>
                        <input type="date" id="date_fin" name="date_fin" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white" required>
                        @error('date_fin')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="motif" class="block">Motif</label>
                        <textarea id="motif" name="motif" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white" rows="4" required></textarea>
                        @error('motif')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] p-3 rounded-xl font-semibold">Envoyer la demande</button>
                </form>
            </div>
        </main>
    </div>
@endsection
