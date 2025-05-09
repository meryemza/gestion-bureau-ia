@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white flex min-h-screen">
    
    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
            <p class="text-sm text-gray-300">Dernière connexion : {{ now()->format('d M Y à H\hi') }}</p>
        </div>
        <!-- KPIs -->
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-10">
            <x-kpi title=" Total des Salaires (DH)" value="90,000" />
            <x-kpi title=" Total des Congés ce mois " value="10" />
            <x-kpi title="Contrats Actifs" value="8" />
        </div>

        <!-- Graphiques (vides ou avec données fixes) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Évolution des Absences</h3>
                <canvas id="absenceChart" height="200"></canvas>
            </div>
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Évolution des Salaires</h3>
                <canvas id="salaryChart" height="200"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Répartition Congés</h3>
                <canvas id="leaveChart" height="200"></canvas>
            </div>
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Types de Contrats</h3>
                <canvas id="contractChart" height="200"></canvas>
            </div>
        </div>


        <!-- Graphique des Recrutements -->
        <div class="mt-10 bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Évolution des Recrutements</h3>
            <canvas id="recrutementChart" height="100"></canvas>
        </div>
    </main>
</div>

<!-- Chart.js avec données statiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Récupérer les données PHP dans JS
    const months = @json($months);
    const absences = @json($absencesByMonth);
    const salaires = @json($salaireByMonth);
    const conges = [@json($congesRestants), @json($congesUtilises)];
    const typesContrats = @json(array_values($typesContrats));
    const recrutements = @json($recrutementsByMonth);
    const congesByMonth = @json($congesByMonth);

    // Absences
    new Chart(document.getElementById('absenceChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Absences',
                data: absences,
                borderColor: '#AC72A1',
                backgroundColor: 'rgba(172, 114, 161, 0.2)',
                fill: true
            }]
        },
        options: {
            scales: { x: { ticks: { color: '#fff' } }, y: { ticks: { color: '#fff' } } },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // Salaires
    new Chart(document.getElementById('salaryChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Salaires',
                data: salaires,
                backgroundColor: '#FBD9FA'
            }]
        },
        options: {
            scales: { x: { ticks: { color: '#fff' } }, y: { ticks: { color: '#fff' } } },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // Répartition Congés
    new Chart(document.getElementById('leaveChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Congés acceptés',
                data: congesByMonth,
                backgroundColor: '#AC72A1'
            }]
        },
        options: {
            scales: { x: { ticks: { color: '#fff' } }, y: { ticks: { color: '#fff' } } },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // Types de Contrats
    new Chart(document.getElementById('contractChart'), {
        type: 'bar',
        data: {
            labels: ['CDI', 'CDD', 'Stage'],
            datasets: [{
                label: 'Contrats',
                data: typesContrats,
                backgroundColor: '#AC72A1'
            }]
        },
        options: {
            scales: { x: { ticks: { color: '#fff' } }, y: { ticks: { color: '#fff' } } },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // Graphe Recrutements par Mois
   new Chart(document.getElementById('recruitmentChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Recrutements',
                data: recrutements,
                borderColor: '#FBD9FA',
                backgroundColor: 'rgba(251, 217, 250, 0.2)',
                fill: true
            }]
        },
        options: {
            scales: { x: { ticks: { color: '#fff' } }, y: { ticks: { color: '#fff' } } },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    const recrutementCtx = document.getElementById('recrutementChart').getContext('2d');
    const recrutementChart = new Chart(recrutementCtx, {
        type: 'line',
        data: {
            labels: @json($recrutementLabels),
            datasets: [{
                label: 'Recrutements',
                data: @json($recrutementData),
                fill: true,
                backgroundColor: 'rgba(172, 114, 161, 0.2)',
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
