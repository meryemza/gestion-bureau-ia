@extends('layouts.app')

@section('content')
<div class="bg-[#070E2A] text-white min-h-screen p-10">
    <div class="max-w-4xl mx-auto bg-[#1A1F3B] p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6">Modifier le Contrat</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rh.contrats.update', $contrat) }}" method="POST">
            @csrf
            @method('PUT')
            @include('rh.contrats._form', ['contrat' => $contrat])
            <div class="flex justify-end">
                <a href="{{ route('rh.contrats.index') }}" class="mr-4 text-[#FBD9FA] underline hover:text-white">Annuler</a>
                <button type="submit" class="bg-[#AC72A1] text-[#070E2A] px-6 py-2 rounded-xl font-semibold hover:bg-[#FBD9FA] transition">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
