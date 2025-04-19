<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Inclusion du CSS et JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Barre supérieure -->
    <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
    <h2 class="text-xl font-semibold">
    @auth
        Bienvenue, {{ Auth::user()->name }}
    @else
        Bienvenue
    @endauth
</h2>

        <div class="flex items-center space-x-4">
        @auth
    <span class="text-gray-600">{{ Auth::user()->email }}</span>
@endauth
@auth
    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="w-8 h-8 rounded-full" alt="avatar">
@endauth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-600 hover:text-red-800">Déconnexion</button>
            </form>
        </div>
    </header>

    <!-- Contenu de la page -->
    <main class="p-6">
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>