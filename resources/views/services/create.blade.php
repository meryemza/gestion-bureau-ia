@extends('layouts.app')

@section('content')
    <h2>Ajouter un service</h2>

    <form method="POST" action="{{ route('services.store') }}">
        @csrf
        <label>Nom :</label>
        <input type="text" name="name" required>

        <label>Description :</label>
        <textarea name="description"></textarea>

        <label>Prix HT :</label>
        <input type="number" step="0.01" name="price_ht" required>

        <label>Prix TTC :</label>
        <input type="number" step="0.01" name="price_ttc" required>

        <button type="submit">Créer</button>
    </form>
@endsection
