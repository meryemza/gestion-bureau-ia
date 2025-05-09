{{-- Debug temporaire --}}
{{-- @php dd($depensesDuMois); @endphp --}}
@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white flex min-h-screen">
    
            

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
            <p class="text-sm text-gray-300">Dernière connexion : {{ now()->format('d M Y à H\hi') }}</p>
        </div>

        <!-- Messages Flash -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif


        @if ($alerteDepense)
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
        <p class="font-semibold">{{ $alerteDepense }}</p>
    </div>
@endif

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-2">Revenus ce mois</h3>
        <p class="text-2xl text-[#FBD9FA] font-bold">
            {{ number_format($revenuMois, 2, ',', ' ') }} DH
        </p>
    </div>
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
    <h3 class="text-xl font-semibold mb-2">Dépenses ce mois</h3>
    <p class="text-2xl text-[#FBD9FA] font-bold">
        {{ number_format($depensesDuMois, 2) }} DH
    </p>
</div>
<div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-2">Projets actifs</h3>
        <p class="text-2xl text-[#FBD9FA] font-bold">{{ $projetsActifs }}</p>
    </div>
           
    <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
    <h3 class="text-xl font-semibold mb-2">Audit de sécurité</h3>
    <p class="text-2xl text-[#FBD9FA] font-bold">
        <a href="{{ route('admin.audit.index') }}" class="inline-block px-6 py-2 bg-[#AC72A1] text-white rounded-lg shadow-md hover:bg-[#8e5995] transition duration-300 ease-in-out">
            Lancer l'Audit
        </a>
    </p>
</div>
        </div>

        <!-- Liste des Congés en attente -->
        <div class="mt-10 bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Congés en attente</h3>

            @if ($conges->isEmpty())
           
                <p class="text-gray-400">Aucun congé en attente pour le moment.</p>
            @else
                <table class="min-w-full table-auto text-left">
                    <thead class="bg-[#AC72A1] text-white">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Date de Début</th>
                            <th class="px-4 py-2">Date de Fin</th>
                            <th class="px-4 py-2">Motif</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conges as $conge)
                            <tr class="border-t border-gray-600 hover:bg-[#2a2e45]">
                                <td class="px-4 py-2">{{ $conge->user->name }}</td>
                                <td class="px-4 py-2">{{ $conge->date_debut }}</td>
                                <td class="px-4 py-2">{{ $conge->date_fin }}</td>
                                <td class="px-4 py-2">{{ $conge->motif }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.accepterConge', $conge->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Accepter</button>
                                    </form>
                                    <form action="{{ route('admin.refuserConge', $conge->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Refuser</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Graphique des Dépenses -->
        <div class="mt-10 bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Évolution des Dépenses</h3>
            <canvas id="depenseChart" height="100"></canvas>
        </div>
    </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('depenseChart').getContext('2d');
    const depenseChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Dépenses (MAD)',
                data: @json($data),
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