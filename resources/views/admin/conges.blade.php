@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] p-6 flex flex-col">
        <h2 class="text-3xl font-bold mb-6">Admin</h2>
        <nav class="space-y-5 font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="block hover:underline">Dashboard</a>
            <a href="#" class="block hover:underline">Dépenses</a>
            <a href="#" class="block hover:underline">Services & Tarifs</a>
            <a href="#" class="block hover:underline">Factures</a>
            <a href="#" class="block hover:underline">Membres</a>
            <a href="{{ route('admin.conges') }}" class="block hover:underline">Congés</a> <!-- Lien vers la page des congés -->
            <a href="#" class="block hover:underline">Projets</a>
            <a href="#" class="block hover:underline">Clients</a>
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
            <h1 class="text-3xl font-bold">Liste des Congés</h1>
        </div>

        <!-- Liste des Congés -->
        <div class="mt-10 bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full table-auto text-sm text-white">
                    <thead>
                        <tr class="bg-[#AC72A1] text-[#070E2A]">
                            <th class="px-4 py-2 text-left">Employé</th>
                            <th class="px-4 py-2 text-left">Date Début</th>
                            <th class="px-4 py-2 text-left">Date Fin</th>
                            <th class="px-4 py-2 text-left">Motif</th>
                            <th class="px-4 py-2 text-left">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($conges as $conge)
                            <tr class="border-t border-gray-600 hover:bg-[#2a2e45]">
                                <td class="px-4 py-2">{{ $conge->user->name }}</td>
                                <td class="px-4 py-2">{{ $conge->date_debut }}</td>
                                <td class="px-4 py-2">{{ $conge->date_fin }}</td>
                                <td class="px-4 py-2">{{ $conge->motif }}</td>
                                <td class="px-4 py-2">
                                    @if ($conge->statut == 'Accepté')
                                        <span class="text-green-400 font-semibold">Accepté</span>
                                    @elseif ($conge->statut == 'Refusé')
                                        <span class="text-red-400 font-semibold">Refusé</span>
                                    @else
                                        <span class="text-yellow-400 font-semibold">En attente</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-400">Aucune demande de congé trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main
