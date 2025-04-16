<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Barre latérale -->
    <aside class="w-64 bg-white shadow-lg px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Mon Tableau de Bord</h1>
        <nav class="space-y-2">
            <a href="{{ route('dashboard.admin') }}" class="block py-2 px-4 rounded hover:bg-gray-200">🏠 Tableau de bord</a>
            <a href="{{ route('users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-200">👤 Utilisateurs</a>
            <a href="{{ route('settings.index') }}" class="block py-2 px-4 rounded hover:bg-gray-200">⚙️ Paramètres</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left py-2 px-4 rounded hover:bg-red-200 text-red-600">🚪 Déconnexion</button>
            </form>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
        <!-- Barre supérieure -->
        <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold">Bienvenue, {{ Auth::user()->name }}</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">{{ Auth::user()->email }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="w-8 h-8 rounded-full" alt="avatar">
            </div>
        </header>

        <!-- Contenu de la page -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>
</html>
