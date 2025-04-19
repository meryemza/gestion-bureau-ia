@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white min-h-screen p-8">

    <!-- Titre -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Dashboard RH</h1>
        <p class="text-sm text-gray-300">Dernière mise à jour : {{ now()->format('d M Y') }}</p>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <x-kpi title="Total Salary (YTD)" :value="$totalSalary" change="-2.4%" />
        <x-kpi title="Average Salary" :value="$averageSalary" change="-1.6%" />
        <x-kpi title="Turnover Rate" :value="$turnoverRate" change="+0.8%" />
        <x-kpi title="Absenteeism Rate" :value="$absenteeism" change="+22.8%" />
        <x-kpi title="Average Age" :value="$avgAge" />
        <x-kpi title="Permanent Rate" :value="$permanentRate" />
    </div>

    <!-- Headcount + Hired/Left -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg text-center">
            <h3 class="text-xl font-semibold mb-2">Headcount</h3>
            <p class="text-3xl font-bold text-[#FBD9FA]">{{ $headcount }}</p>
            <canvas id="headcountChart" class="mt-4" height="150"></canvas>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg text-center">
                <h4 class="text-lg text-gray-300">Hired</h4>
                <p class="text-2xl font-bold text-[#FBD9FA]">{{ $hired }}</p>
            </div>
            <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg text-center">
                <h4 class="text-lg text-gray-300">Left</h4>
                <p class="text-2xl font-bold text-[#FBD9FA]">{{ $left }}</p>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Employees by Gender</h3>
            <canvas id="genderChart" height="200"></canvas>
        </div>
        <div class="bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Total Salary (Mensuel)</h3>
            <canvas id="salaryChart" height="200"></canvas>
        </div>
    </div>

    <div class="mt-6 bg-[#1A1F3B] p-6 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Hired vs Left</h3>
        <canvas id="hiredLeftChart" height="200"></canvas>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Headcount Donut
    new Chart(document.getElementById('headcountChart'), {
        type: 'doughnut',
        data: {
            labels: ['Hommes', 'Femmes'],
            datasets: [{
                data: @json($headcountData),
                backgroundColor: ['#AC72A1', '#FBD9FA']
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: { labels: { color: '#fff' }, position: 'bottom' }
            }
        }
    });

    // Gender bar chart
    new Chart(document.getElementById('genderChart'), {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [
                {
                    label: 'Hommes',
                    data: @json($genderM),
                    backgroundColor: '#AC72A1'
                },
                {
                    label: 'Femmes',
                    data: @json($genderF),
                    backgroundColor: '#FBD9FA'
                }
            ]
        },
        options: {
            scales: {
                x: { ticks: { color: '#fff' } },
                y: { ticks: { color: '#fff' }, beginAtZero: true }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // Salary Bar
    new Chart(document.getElementById('salaryChart'), {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Salaire total',
                data: @json($salaryPerMonth),
                backgroundColor: '#FBD9FA'
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: '#fff' } },
                y: { ticks: { color: '#fff' }, beginAtZero: true }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // Hired vs Left
    new Chart(document.getElementById('hiredLeftChart'), {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [
                {
                    label: 'Hired',
                    data: @json($hiredPerMonth),
                    backgroundColor: '#AC72A1'
                },
                {
                    label: 'Left',
                    data: @json($leftPerMonth),
                    backgroundColor: '#FBD9FA'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { labels: { color: '#fff' } }
            },
            scales: {
                x: { ticks: { color: '#fff' } },
                y: { ticks: { color: '#fff' }, beginAtZero: true }
            }
        }
    });
</script>
@endsection
