@extends('layouts.app')

@section('content')
<div class="p-10 text-white bg-[#070E2A] min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-center">Liste des Recrutements</h1>
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-600 text-white rounded shadow">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4 flex justify-end">
        <a href="{{ route('rh.recrutement.create') }}" class="bg-[#AC72A1] hover:bg-[#FBD9FA] text-[#070E2A] font-semibold px-4 py-2 rounded-lg">Nouveau</a>
    </div>
    <table class="min-w-full bg-[#1A1F3B] rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-4">Nom</th>
                <th class="py-2 px-4">Poste</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">CV</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recrutements as $recrutement)
                <tr>
                    <td class="py-2 px-4">{{ $recrutement->nom }}</td>
                    <td class="py-2 px-4">{{ $recrutement->poste }}</td>
                    <td class="py-2 px-4">{{ $recrutement->email }}</td>
                    <td class="py-2 px-4">
                        @if($recrutement->cv)
                            <a href="{{ asset('storage/' . $recrutement->cv) }}" target="_blank" class="underline">Voir CV</a>
                        @else
                            Aucun CV
                        @endif
                    </td>
                    <td class="py-2 px-4 flex gap-2">
                        <form action="{{ route('rh.recrutement.accepter', $recrutement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-500">Accepter</button>
                        </form>
                        <form action="{{ route('rh.recrutement.refuser', $recrutement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-red-500">Refuser</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">Aucun recrutement.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $recrutements->links() }}
    </div>
</div>
@endsection
