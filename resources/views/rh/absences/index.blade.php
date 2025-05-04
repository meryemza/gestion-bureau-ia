@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <!-- Titre principal -->
    <h1 class="text-3xl font-bold mb-6 text-center">Liste des Absences et Présences</h1>

    <!-- Message de succès -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tableau des absences -->
    <div class="overflow-x-auto bg-[#1A1F3B] p-6 rounded-lg shadow-lg mb-10">
        <table class="min-w-full text-white">
            <thead>
                <tr class="bg-[#AC72A1] text-[#070E2A]">
                    <th class="py-3 px-6 text-left">Nom de l'employé</th>
                    <th class="py-3 px-6 text-left">Statut</th>
                    <th class="py-3 px-6 text-left">Justification</th>
                    <th class="py-3 px-6 text-left">Date</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($absences as $absence)
                    <tr class="border-b border-gray-700">
                        <td class="py-4 px-6">{{ $absence->employee->name }}</td>
                        <td class="py-4 px-6">
                            @if($absence->status == 'Présent')
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">Présent</span>
                            @else
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">Absent</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            {{ $absence->reason ?? 'Aucune' }}
                        </td>
                        <td class="py-4 px-6">{{ $absence->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Graphiques : cercle + barre dans le même bloc -->
    <div class="flex justify-between gap-6">
        <!-- Diagramme circulaire -->
        <div class="bg-[#1A1F3B] p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-6 text-center">Statistiques des Présences</h2>
            <canvas id="absenceChart" width="400" height="400" class="mx-auto"></canvas>
        </div>

        <!-- Graphique en courbe pour les absences par mois -->
        <div class="bg-[#1A1F3B] p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-6 text-center">Évolution des Absences (par mois)</h2>
            <canvas id="absenceLineChart" width="400" height="400" class="mx-auto"></canvas>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<pre>
    Mois : @json($months)
    Données des absences : @json($absencesData)
</pre>
<script>
    // Graphique circulaire
    const ctx1 = document.getElementById('absenceChart').getContext('2d');
    const data1 = {
        labels: ['Présent', 'Absent'],
        datasets: [{
            label: 'Absences vs Présences',
            data: [{{ $presentCount }}, {{ $absentCount }}],  // Valeurs dynamiques
            backgroundColor: ['#AC72A1', '#FBD9FA'],
            borderColor: ['#1A1F3B', '#1A1F3B'],
            borderWidth: 2
        }]
    };

    const config1 = {
        type: 'pie',
        data: data1,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: 'white',
                        font: { size: 16 }
                    }
                }
            }
        }  // Remplacer }; par }
    };

    new Chart(ctx1, config1);

    // Graphique en courbe pour les absences par mois
    const ctx2 = document.getElementById('absenceLineChart').getContext('2d');
    const data2 = {
        labels: @json($months),  // Mois dynamiques
        datasets: [{
            label: 'Absences',
            data: @json($absencesData),  // Données dynamiques
            borderColor: '#AC72A1',
            backgroundColor: 'rgba(172, 114, 161, 0.2)',
            fill: true,
            tension: 0.4
        }]
    };

    const config2 = {
        type: 'line',
        data: data2,
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: { color: '#ffffff' },
                    grid: { color: '#333' }
                },
                y: {
                    ticks: { color: '#ffffff' },
                    grid: { color: '#333' }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff'
                    }
                }
            }
        }
    };

    new Chart(ctx2, config2);
</script>
@endpush