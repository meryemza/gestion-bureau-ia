@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#4C4F73] text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-4">Détails de l'absence</h1>

    <div class="space-y-4">
        <p><strong>Employé:</strong> {{ $absence->employee->user->name }}</p>
        <p><strong>Type:</strong> {{ $absence->type }}</p>
        <p><strong>Date de début:</strong> {{ $absence->start_date->format('d/m/Y') }}</p>
        <p><strong>Date de fin:</strong> {{ $absence->end_date->format('d/m/Y') }}</p>
        <p><strong>Raison:</strong> {{ $absence->reason ?? 'Aucune raison fournie' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('rh.absences.index') }}" class="bg-[#9C76B9] px-4 py-2 rounded hover:bg-[#B186C1]">Retour à la liste des absences</a>
    </div>
</div>
@endsection
