@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#101636] min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Ajouter un service</h1>

    <form method="POST" action="{{ route('services.store') }}" class="space-y-6 bg-[#232946] p-8 rounded-xl shadow-md">
        @csrf

        {{-- Nom --}}
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Nom du service</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required
                class="w-full px-4 py-2 rounded-lg bg-[#3a3f5a] text-white focus:outline-none focus:ring-2 focus:ring-[#AC72A1]">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
            <textarea name="description" rows="4" required
                class="w-full px-4 py-2 rounded-lg bg-[#3a3f5a] text-white focus:outline-none focus:ring-2 focus:ring-[#AC72A1]">{{ old('description') }}</textarea>
        </div>

        {{-- Prix HT --}}
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Prix HT</label>
            <input type="number" step="0.01" name="prix_ht" id="prix_ht" value="{{ old('prix_ht') }}" required
                class="w-full px-4 py-2 rounded-lg bg-[#3a3f5a] text-white focus:outline-none focus:ring-2 focus:ring-[#AC72A1]">
        </div>

        {{-- Prix TTC (readonly) --}}
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Prix TTC</label>
            <input type="number" step="0.01" id="prix_ttc" readonly
                class="w-full px-4 py-2 rounded-lg bg-[#3a3f5a] text-white focus:outline-none focus:ring-2 focus:ring-[#AC72A1]">
        </div>

        {{-- Champ caché à envoyer --}}
        <input type="hidden" name="prix_ttc_hidden" id="prix_ttc_hidden">

        {{-- Bouton --}}
        <div class="flex justify-end">
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition">
                Ajouter
            </button>
        </div>
    </form>
</div>

<script>
    function updateTTC() {
        const ht = parseFloat(document.getElementById('prix_ht').value) || 0;
        const ttc = (ht * 1.2).toFixed(2);
        document.getElementById('prix_ttc').value = ttc;
        document.getElementById('prix_ttc_hidden').value = ttc;
    }

    document.getElementById('prix_ht').addEventListener('input', updateTTC);
    window.addEventListener('DOMContentLoaded', updateTTC);
</script>
@endsection
