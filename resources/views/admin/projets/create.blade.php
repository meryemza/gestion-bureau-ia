@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un Projet</h2>
    <form action="{{ route('admin.projets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre du projet</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" class="form-select" required>
                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="termine" {{ old('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('admin.projets') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

