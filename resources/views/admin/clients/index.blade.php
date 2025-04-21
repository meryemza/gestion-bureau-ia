@extends('layouts.app')

@section('content')
    <div class=" p-7 text-white bg-[#4C4F73] min-h-screen">
        <h1 class="text-3xl font-bold mb-6">Clients</h1>
        <a href="{{ route('admin.clients.create') }}" class="btn py-3 px-6 bg-[#9C76B9] text-white rounded-md hover:bg-[#B186C1] transition duration-200">Ajouter un client</a>
        
        <table class="table w-full mt-4 bg-[#5D6C91] rounded-xl shadow-lg">
                <thead>
                    <tr>
                        <th class="text-lg font-medium p-3">Nom</th>
                        <th class="text-lg font-medium p-3">Email</th>
                        <th class="text-lg font-medium p-3">Téléphone</th>
                    <th class="text-lg font-medium p-3">Adresse</th>
                        <th class="text-lg font-medium p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="bg-[#6D7B99]">
                            <td class="text-white p-3">{{ $client->nom }}</td>
                            <td class="text-white p-3">{{ $client->email }}</td>
                            <td class="text-white p-3">{{ $client->telephone }}</td>
                        <td class="text-white p-3">{{ $client->adresse }}</td>
                            <td class="p-3">
                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn py-2 px-4 bg-[#B186C1] text-white rounded-md hover:bg-[#9C76B9] transition duration-200">Éditer</a>
                                <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn py-2 px-4 bg-[#E57A8D] text-white rounded-md hover:bg-[#F48E9C] transition duration-200">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection

