<!-- resources/views/livewire/dashboard-stats.blade.php -->

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-[#1e293b] p-6 rounded-xl shadow-md">
        <p class="text-sm text-gray-400">Taux d’activité</p>
        <p class="text-2xl font-semibold mt-2">{{ $stats['activity_rate'] }}%</p>
    </div>
    <div class="bg-[#1e293b] p-6 rounded-xl shadow-md">
        <p class="text-sm text-gray-400">Utilisateurs</p>
        <p class="text-2xl font-semibold mt-2">{{ $stats['user_count'] }}</p>
    </div>
    <div class="bg-[#1e293b] p-6 rounded-xl shadow-md">
        <p class="text-sm text-gray-400">Sessions</p>
        <p class="text-2xl font-semibold mt-2">{{ $stats['sessions'] }}</p>
    </div>
    <div class="bg-[#1e293b] p-6 rounded-xl shadow-md">
        <p class="text-sm text-gray-400">Actifs</p>
        <p class="text-2xl font-semibold mt-2">{{ $stats['active_users'] }}</p>
    </div>
</div>

