@extends('layouts.app')

@section('content')
<div class="p-6 bg-[#4C4F73] text-white min-h-screen">
    <h2 class="text-3xl font-bold mb-4">Modifier une Absence</h2>

    <form action="{{ route('rh.absences.update', $absence->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="employee_id" class="block">Employé</label>
            <select name="employee_id" id="employee_id" class="text-black w-full p-2 rounded">
                @foreach($employes as $employe)
                    <option value="{{ $employe->id }}" {{ $absence->employee_id == $employe->id ? 'selected' : '' }}>
                        {{ $employe->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date" class="block">Date de début</label>
            <input type="date" name="start_date" id="start_date" class="text-black w-full p-2 rounded" value="{{ $absence->start_date }}" required>
        </div>

        <div>
            <label for="end_date" class="block">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="text-black w-full p-2 rounded" value="{{ $absence->end_date }}" required>
        </div>

        <div>
            <label for="reason" class="block">Raison</label>
            <textarea name="reason" id="reason" class="text-black w-full p-2 rounded" required>{{ $absence->reason }}</textarea>
        </div>

        <button type="submit" class="bg-[#9C76B9] px-4 py-2 rounded hover:bg-[#B186C1]">Mettre à jour</button>
    </form>
</div>
@endsection
