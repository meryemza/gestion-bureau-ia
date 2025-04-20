@extends('layouts.app')

@section('content')
    <h2>Modifier le service</h2>

    <form method="POST" action="{{ route('services.update', $service->id) }}">
        @csrf
        @method('PUT')

        <label>Nom :</label>
        <input type="text" name="name" value="{{ old('name', $service->name) }}" required>

        <label>Description :</label>
        <textarea name="description">{{ old('description', $service->description) }}</textarea>

        <label>Prix HT :</label>
        <input type="number" step="0.01" name="price_ht" id="price_ht" value="{{ old('price_ht', $service->price_ht) }}" required>

        <label>Prix TTC :</label>
        <input type="number" step="0.01" name="price_ttc" id="price_ttc" value="{{ old('price_ttc', $service->price_ttc) }}" required>

        <button type="submit">Mettre à jour</button>
    </form>

    <script>
        document.getElementById('price_ht').addEventListener('input', function () {
            const ht = parseFloat(this.value) || 0;
            const ttc = (ht * 1.2).toFixed(2); // 20% TVA
            document.getElementById('price_ttc').value = ttc;
        });
    </script>
@endsection
