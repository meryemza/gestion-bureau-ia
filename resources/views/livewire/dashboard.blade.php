<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-gray-600">Total Dépenses</h2>
            <p class="text-2xl font-semibold text-red-500">{{ number_format($depenses, 2) }} MAD</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-gray-600">Total Revenus</h2>
            <p class="text-2xl font-semibold text-green-500">{{ number_format($revenus, 2) }} MAD</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-gray-600">Projets En Cours</h2>
            <p class="text-2xl font-semibold text-blue-500">{{ $projets }}</p>
        </div>
    </div>

    <div class="mt-10">
        <canvas id="financeChart"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('financeChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fév', 'Mars', 'Avril'],
            datasets: [{
                label: 'Dépenses mensuelles',
                data: [1200, 1800, 1400, 2200],
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderRadius: 10
            }]
        }
    });
</script>
@endpush
