@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#4C4F73] min-h-screen">
    <h2 class="text-3xl font-bold mb-6">Modifier le Client</h2>
    
    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" class="bg-[#5D6C91] p-6 rounded-xl shadow-lg">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-4">
            <label for="nom" class="block text-lg font-medium mb-2">Nom</label>
            <input type="text" name="nom" value="{{ $client->nom }}" class="w-full p-3 bg-[#6D7B99] text-white rounded-md border border-[#7E8CA5]" required>
            @error('nom')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-lg font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ $client->email }}" class="w-full p-3 bg-[#6D7B99] text-white rounded-md border border-[#7E8CA5]" required>
            @error('email')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Téléphone -->
        <div class="mb-4">
            <label for="telephone" class="block text-lg font-medium mb-2">Téléphone</label>
            <input type="text" name="telephone" value="{{ $client->telephone }}" class="w-full p-3 bg-[#6D7B99] text-white rounded-md border border-[#7E8CA5]">
            @error('telephone')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Adresse -->
        <div class="mb-4">
            <label for="adresse" class="block text-lg font-medium mb-2">Adresse</label>
            <textarea name="adresse" class="w-full p-3 bg-[#6D7B99] text-white rounded-md border border-[#7E8CA5]" rows="3">{{ $client->adresse }}</textarea>
            @error('adresse')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Boutons -->
        <button type="submit" class="w-full py-3 bg-[#9C76B9] text-white rounded-md hover:bg-[#B186C1] transition duration-200">Mettre à jour</button>
        <a href="{{ route('admin.clients.index') }}" class="block text-center mt-4 text-[#C0C7D4] hover:text-white">Annuler</a>
    </form>
</div>
@endsection
