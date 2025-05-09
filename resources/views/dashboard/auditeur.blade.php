@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#070E2A] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-8">Tableau de bord de l'Auditeur</h1>

        <!-- Statistiques générales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total des audits -->
            <div class="bg-[#1A1F3B] rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Total des audits</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['total_audits'] }}</p>
                    </div>
                    <div class="bg-[#AC72A1] p-3 rounded-lg">
                        <i class="fas fa-clipboard-list text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Audits terminés -->
            <div class="bg-[#1A1F3B] rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Audits terminés</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['completed_audits'] }}</p>
                    </div>
                    <div class="bg-green-500 p-3 rounded-lg">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Audits en cours -->
            <div class="bg-[#1A1F3B] rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Audits en cours</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['in_progress_audits'] }}</p>
                    </div>
                    <div class="bg-yellow-500 p-3 rounded-lg">
                        <i class="fas fa-spinner text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Score moyen -->
            <div class="bg-[#1A1F3B] rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Score moyen</p>
                        <p class="text-2xl font-bold text-white">{{ number_format($stats['average_score'], 1) }}%</p>
                    </div>
                    <div class="bg-blue-500 p-3 rounded-lg">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audits récents -->
        <div class="bg-[#1A1F3B] rounded-xl p-6 shadow-lg">
            <h2 class="text-xl font-bold text-white mb-4">Audits récents</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Projet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($stats['recent_audits'] as $audit)
                            <tr class="hover:bg-[#232946] transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $audit->project_name }}</div>
                                    <div class="text-sm text-gray-400">{{ $audit->url }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#3a3f5a] text-gray-300">
                                        {{ ucfirst($audit->audit_type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($audit->status === 'completed') bg-green-100 text-green-800
                                        @elseif($audit->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @elseif($audit->status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($audit->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white">{{ $audit->severity_score }}%</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $audit->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                    Aucun audit récent
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
