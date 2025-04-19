@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Liste des Employés</h1>

    <div class="overflow-x-auto rounded-lg shadow-lg bg-[#1A1F3B]">
        <table class="min-w-full table-auto text-left">
            <thead class="bg-[#AC72A1] text-white">
                <tr>
                    <th class="px-4 py-2">name</th>
                    <th class="px-4 py-2">Poste</th>
                    <th class="px-4 py-2">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employes as $employe)
                    <tr class="border-t border-gray-600 hover:bg-[#2a2e45]">
                        <td class="px-4 py-2">{{ $employe->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $employe->poste ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $employe->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-400">Aucun employé trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
