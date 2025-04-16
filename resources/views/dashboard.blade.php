@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">📈 Statistiques</h3>
            <p class="text-gray-500">Nombre d'utilisateurs: 120</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">📝 Tâches</h3>
            <p class="text-gray-500">Tâches en cours: 5</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">📦 Commandes</h3>
            <p class="text-gray-500">Commandes en attente: 3</p>
        </div>
    </div>
@endsection
