@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] p-6 flex flex-col h-screen">
        <h2 class="text-3xl font-bold mb-6">Admin</h2>
        <nav class="space-y-5 font-semibold">
            <a href="#" class="block hover:underline">Dépenses</a>
            <a href="#" class="block hover:underline">Services & Tarifs</a>
            <a href="#" class="block hover:underline">Factures</a>
            <a href="#" class="block hover:underline">Membres</a>
            <a href="#" class="block hover:underline">Salaires</a>
            <a href="#" class="block hover:underline">Congés</a>
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
            <h1 class="text-3xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
            <p class="text-sm text-gray-300">Dernière connexion : {{ now()->format('d M Y à H\hi') }}</p>
        </div>

        <!-- Vue d’ensemble dynamique -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-2">Revenus ce mois</h3>
                <p class="text-2xl text-[#FBD9FA] font-bold">12,500 DH</p>
            </div>
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-2">Dépenses ce mois</h3>
                <p class="text-2xl text-[#FBD9FA] font-bold">5,200 DH</p>
            </div>
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-2">Projets actifs</h3>
                <p class="text-2xl text-[#FBD9FA] font-bold">7</p>
            </div>
        </div>

        <!-- Graphique des Dépenses -->
        <div class="mt-10 bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Évolution des Dépenses</h3>
            <canvas id="depenseChart" height="100"></canvas>
        </div>
    </main>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('depenseChart').getContext('2d');
    const depenseChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),  // Mois (ex: Janvier, Février...)
            datasets: [{
                label: 'Dépenses (MAD)',
                data: @json($data),  // Montants des dépenses par mois
                fill: true,
                backgroundColor: 'rgba(252, 182, 255, 0.2)',
                borderColor: '#AC72A1',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                x: {
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                }
            },
            plugins: {
                legend: { labels: { color: '#fff' } }
            }
        }
    });
</script>
@endsection