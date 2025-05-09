@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800">Liste des Audits</h1>

    <table class="min-w-full">
        <thead>
            <tr>
                <th>Nom du projet</th>
                <th>URL</th>
                <th>Statut</th>
                <th>Score de Sévérité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audits as $audit)
            <tr>
                <td>{{ $audit->project_name }}</td>
                <td>{{ $audit->url }}</td>
                <td>{{ $audit->status }}</td>
                <td>{{ $audit->severity_score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

