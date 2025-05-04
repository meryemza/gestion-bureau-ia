@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <!-- Titre principal -->
    <h1 class="text-3xl font-bold mb-6 text-center">Gestion des Absences</h1>

    <!-- Message de succès -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire de gestion des absences -->
    <form action="{{ route('rh.absences.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            @foreach ($employees as $employe)
                <div class="p-4 bg-[#1A1F3B] rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-white">{{ $employe->name }}</h2>

                    <div class="flex items-center gap-6 mb-2">
                        <label class="flex items-center">
                            <input type="radio" name="presences[{{ $employe->id }}]" value="Présent" checked class="mr-2">
                            Présent
                        </label>

                        <label class="flex items-center">
                            <input type="radio" name="presences[{{ $employe->id }}]" value="Absent" class="mr-2">
                            Absent
                        </label>
                    </div>

                    <!-- Champ justification, visible seulement si Absent est choisi -->
                    <div class="mb-4" id="justification-{{ $employe->id }}" style="display:none;">
                        <label for="reason-{{ $employe->id }}" class="block text-sm text-white">Justification (obligatoire si absent)</label>
                        <textarea name="reasons[{{ $employe->id }}]" id="reason-{{ $employe->id }}" rows="3" class="w-full p-2 mt-2 bg-[#1A1F3B] text-white rounded-lg" placeholder="Entrez la raison de l'absence"></textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bouton d'enregistrement -->
        <div class="mt-6 flex justify-center">
            <button type="submit" class="bg-[#AC72A1] hover:bg-[#FBD9FA] text-[#070E2A] font-semibold px-6 py-3 rounded-lg">
                Enregistrer
            </button>
        </div>
    </form>
</div>

<script>
    // Script pour afficher le champ justification seulement si Absent est sélectionné
    document.querySelectorAll('input[type="radio"][value="Absent"]').forEach(input => {
        input.addEventListener('change', function() {
            const employeeId = this.name.split('[')[1].split(']')[0]; // Récupérer l'ID de l'employé
            const justificationField = document.getElementById('justification-' + employeeId);

            if (this.checked) {
                justificationField.style.display = 'block'; // Afficher la justification
            } else {
                justificationField.style.display = 'none'; // Masquer la justification
            }
        });
    });
</script>
@endsection
