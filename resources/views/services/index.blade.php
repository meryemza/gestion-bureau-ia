@extends('layouts.app')

@section('content')
    <h2>Liste des services</h2>
    <a href="{{ route('services.create') }}">Ajouter un service</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->price_ht }} DH</td>
                    <td>{{ $service->price_ttc }} DH</td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}">Modifier</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
