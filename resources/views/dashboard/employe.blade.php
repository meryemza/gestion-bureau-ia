@extends('layouts.app')

@section('content')
    <div class="bg-[#070E2A] text-white min-h-screen">
       <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] p-6 space-y-6">
        <h2 class="text-2xl font-bold">Employé</h2>
        <nav class="space-y-4">
            <a href="#" class="block font-semibold hover:underline">Tableau de bord</a>
            <a href="#" class="block font-semibold hover:underline">Projets</a>
            <a href="#" class="block font-semibold hover:underline">Salaire / Factures</a>
            <a href="#" class="block font-semibold hover:underline">Messagerie</a>
            <a href="#" class="block font-semibold hover:underline">Mon Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <!--<button type="submit" class="block font-semibold hover:underline text-red-600">
                    Déconnexion
                </button>-->
            </form>
        </nav>
    </aside>

        <!-- Main content -->
        <main class="flex-1 p-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
                <p class="text-sm text-gray-300">Dernière connexion : {{ now()->format('d M Y à H\hi') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Mes Documents</h3>
                    <p class="text-sm text-gray-300">Voir les documents à lire ou signer</p>
                </div>

                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Planning</h3>
                    <p class="text-sm text-gray-300">Consultez votre emploi du temps</p>
                </div>

                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Fiches de paie</h3>
                    <p class="text-sm text-gray-300">Accéder à vos bulletins de salaire</p>
                </div>

                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Mes Tâches</h3>
                    <p class="text-sm text-gray-300">Voir les tâches attribuées</p>
                </div>

                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Notifications</h3>
                    <p class="text-sm text-gray-300">Derniers messages et alertes</p>
                </div>

                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Mon Profil</h3>
                    <p class="text-sm text-gray-300">Modifier vos informations</p>
                </div>

                <!-- Bouton Demande de Congé -->
                <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Demande de Congé</h3>
                    <p class="text-sm text-gray-300">Soumettre une demande de congé</p>
                    <a href="{{ route('employe.conges.demande') }}" class="inline-block mt-4 px-4 py-2 bg-gradient-to-r from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] rounded-xl text-center font-semibold">Faire une demande</a>
                </div>
            </div>
        </main>
    </div>
@endsection
