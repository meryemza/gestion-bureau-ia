@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] p-6 flex flex-col">
        <h2 class="text-3xl font-bold mb-6">Congés</h2>
        <nav class="space-y-5 font-semibold">
            <a href="#" class="block hover:underline">Demander Congé</a>
            <a href="#" class="block hover:underline">Historique des Congés</a>
            <a href="#" class="block hover:underline">Validation</a>
            <a href="#" class="block hover:underline">Statistiques</a>
            <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf
                <button type="submit" class="block text-left text-red-600 hover:underline">Déconnexion</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
            <p class="text-sm text-gray-300">Dernière connexion : {{ now()->format('d M Y à H\hi') }}</p>
        </div>

        <!-- Informations sur les Congés -->
        <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Demander un Congé</h3>
            <form action="#" method="POST">
                <!-- Formulaire de demande de congé -->
                <input type="text" name="motif" placeholder="Motif du congé" class="mb-4 p-2 w-full">
                <button type="submit" class="bg-[#AC72A1] text-white py-2 px-6 rounded-lg">Soumettre la demande</button>
            </form>
        </div>
    </main>
</div>
@endsection
