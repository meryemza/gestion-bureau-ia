
@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Modifier le Projet</h2>
    <form action="{{ route('admin.projets.update', $projet->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ $projet->nom}}" required>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" class="form-select" required>
                <option value="en cours" {{ $projet->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                <option value="terminé" {{ $projet->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
                <option value="en attente" {{ $projet->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('admin.projets') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
