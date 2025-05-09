@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg py-10">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Lancer un nouvel audit de sécurité</h2>
        <form action="{{ route('audits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Type d'analyse</label>
                <div class="flex space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="scan_type" value="file" class="form-radio" checked onclick="document.getElementById('file-upload').style.display='block';document.getElementById('url-input').style.display='none';">
                        <span class="ml-2">Fichier</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="scan_type" value="url" class="form-radio" onclick="document.getElementById('file-upload').style.display='none';document.getElementById('url-input').style.display='block';">
                        <span class="ml-2">URL</span>
                    </label>
                </div>
            </div>
            <div id="file-upload" class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Déposez votre fichier</label>
                <input type="file" name="file" class="block w-full text-gray-700 border rounded p-2" accept="*/*">
            </div>
            <div id="url-input" class="mb-4" style="display:none;">
                <label class="block text-gray-700 font-semibold mb-2">Ou saisissez l'URL à analyser</label>
                <input type="url" name="url" class="block w-full text-gray-700 border rounded p-2" placeholder="https://exemple.com">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nom du projet</label>
                <input type="text" name="project_name" class="block w-full text-gray-700 border rounded p-2" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors">Lancer l'audit</button>
        </form>
    </div>
</div>
@endsection