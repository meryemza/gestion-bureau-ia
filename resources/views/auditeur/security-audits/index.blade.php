@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#070E2A] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Audits de Sécurité</h1>
            <a href="{{ route('auditeur.security-audits.create') }}" 
               class="bg-[#AC72A1] hover:bg-[#8B5A8F] text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>Nouvel Audit
            </a>
        </div>

        {{-- Filtres --}}
        <div class="bg-[#1A1F3B] rounded-xl p-4 mb-6">
            <form action="{{ route('auditeur.security-audits.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Statut</label>
                    <select name="status" class="w-full rounded-lg bg-[#3a3f5a] text-white border-0 focus:ring-2 focus:ring-[#AC72A1]">
                        <option value="">Tous</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Échoué</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Priorité</label>
                    <select name="priority" class="w-full rounded-lg bg-[#3a3f5a] text-white border-0 focus:ring-2 focus:ring-[#AC72A1]">
                        <option value="">Toutes</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Haute</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Basse</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Type d'Audit</label>
                    <select name="audit_type" class="w-full rounded-lg bg-[#3a3f5a] text-white border-0 focus:ring-2 focus:ring-[#AC72A1]">
                        <option value="">Tous</option>
                        <option value="standard" {{ request('audit_type') == 'standard' ? 'selected' : '' }}>Standard</option>
                        <option value="comprehensive" {{ request('audit_type') == 'comprehensive' ? 'selected' : '' }}>Complet</option>
                        <option value="quick" {{ request('audit_type') == 'quick' ? 'selected' : '' }}>Rapide</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#AC72A1] hover:bg-[#8B5A8F] text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-filter mr-2"></i>Filtrer
                    </button>
                </div>
            </form>
        </div>

        {{-- Liste des audits --}}
        <div class="bg-[#1A1F3B] rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-[#232946]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Projet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Priorité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#1A1F3B] divide-y divide-gray-700">
                        @forelse($audits as $audit)
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
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($audit->priority === 'high') bg-red-100 text-red-800
                                        @elseif($audit->priority === 'medium') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($audit->priority) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white">{{ $audit->severity_score }}%</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $audit->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('auditeur.security-audits.show', $audit) }}" 
                                           class="text-[#AC72A1] hover:text-[#8B5A8F] transition duration-200">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('auditeur.security-audits.report', $audit) }}" 
                                           class="text-[#AC72A1] hover:text-[#8B5A8F] transition duration-200">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        @if($audit->status === 'pending')
                                            <form action="{{ route('auditeur.security-audits.start', $audit) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-[#AC72A1] hover:text-[#8B5A8F] transition duration-200">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                                    Aucun audit trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $audits->links() }}
        </div>
    </div>
</div>
@endsection 