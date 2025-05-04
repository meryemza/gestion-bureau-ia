@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Liste des Salaires</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-[#1A1F3B] p-6 rounded-lg shadow-lg mb-10">
        <table class="min-w-full text-white">
            <thead>
                <tr class="bg-[#AC72A1] text-[#070E2A]">
                    <th class="py-3 px-6 text-left">Employé</th>
                    <th class="py-3 px-6 text-left">Salaire de base (€)</th>
                    <th class="py-3 px-6 text-left">Salaire variable (€)</th>
                    <th class="py-3 px-6 text-left">Statut</th>
                    <th class="py-3 px-6 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaires as $salaire)
                    <tr class="border-b border-gray-700">
                        <td class="py-4 px-6">{{ $salaire->employe->name ?? 'N/A' }}</td>
                        <td class="py-4 px-6">{{ $salaire->montant ?? '0' }} €</td>
                        <td class="py-4 px-6">{{ $salaire->variable ?? '0' }} €</td>
                        <td class="py-4 px-6">
                            @if($salaire->status == 'Versé')
                                <span class="bg-green-500 text-white px-2 py-1 rounded">Versé</span>
                            @else
                                <span class="bg-red-500 text-white px-2 py-1 rounded">Non versé</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ $salaire->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between gap-6">
        <div class="bg-[#1A1F3B] p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-6 text-center">Répartition des Salaires</h2>
            <canvas id="salairePieChart" width="400" height="400" class="mx-auto"></canvas>
        </div>

        <div class="bg-[#1A1F3B] p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-6 text-center">Évolution des Salaires (par mois)</h2>
            <canvas id="salaireLineChart" width="400" height="400" class="mx-auto"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const salairePie = new Chart(document.getElementById('salairePieChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Versés', 'Non versés'],
            datasets: [{
                data: [{{ $paidCount }}, {{ $unpaidCount }}],
                backgroundColor: ['#4CAF50', '#F44336']
            }]
        },
        options: { responsive: true }
    });

    const salaireLine = new Chart(document.getElementById('salaireLineChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Salaires mensuels (€)',
                data: @json($salaireData),
                backgroundColor: 'rgba(172, 114, 161, 0.2)',
                borderColor: '#AC72A1',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
