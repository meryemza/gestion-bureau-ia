<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @livewireStyles
    @yield('styles')
</head>

<body class="bg-gray-100">

    <!-- Layout principal -->
    <div class="flex min-h-screen">

        <!-- Sidebar gauche -->
        <aside class="fixed top-0 left-0 w-72 h-screen bg-gradient-to-br from-[#AC72A1] to-[#FBD9FA] text-[#070E2A] p-6 flex flex-col">
    <!-- Logo WebCinq -->
    <div class="flex items-center gap-2 mb-6">
    <span class="text-3xl font-bold text-gradient bg-clip-text text-transparent bg-gradient-to-r from-[#AC72A1] via-[#FBD9FA] to-[#070E2A]">
        WebCinq
    </span>
</div>

    <!-- Compte utilisateur -->
    <h2 class="text-xl font-bold mb-4">RH Dashboard</h2>
    <div class="flex items-center gap-3 mb-6 ml-[-8px]">
    <!-- Initiale de l'utilisateur (icône) -->
    <div class="h-8 w-8 rounded-full bg-[#070E2A] text-white flex items-center justify-center font-bold uppercase">
        {{ Str::substr(Auth::user()->name, 0, 1) }}
    </div>
    <!-- Nom / Email de l'utilisateur -->
    <div class="text-sm font-medium truncate">
        {{ Auth::user()->email }}
    </div>
</div>
    <!-- Navigation -->
    <nav class="space-y-4 font-semibold">
        <a href="#" class="flex items-center gap-3 hover:underline">
            <i class="fas fa-tachometer-alt"></i>
            Tableau de bord
        </a>
        <a href="{{ route('rh.absences.create') }}" class="flex items-center gap-3 hover:underline {{ request()->routeIs('rh.absences.*') ? 'underline font-bold' : '' }}">
            <i class="fas fa-calendar-day"></i>
            Absences
        </a>
        <a href="{{ route('rh.contrats.index') }}" class="flex items-center gap-3 hover:underline {{ request()->routeIs('rh.contrats.*') ? 'underline font-bold' : '' }}">
            <i class="fas fa-file-alt"></i>
            Contrats
        </a>
        <a href="{{ route('rh.salaires.index') }}" class="flex items-center gap-3 hover:underline">
    <i class="fas fa-dollar-sign"></i>
    Salaires
</a>
        <a href="#" class="flex items-center gap-3 hover:underline">
            <i class="fas fa-users"></i>
            Recrutements
        </a>

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}" class="pt-6">
            @csrf
            <button type="submit" class="flex items-center gap-3 text-red-600 hover:underline">
                <i class="fas fa-sign-out-alt"></i>
                Déconnexion
            </button>
        </form>
    </nav>
</aside>


        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col min-h-screen ml-72">
            <!-- En-tête -->
            <header class="bg-[#070E2A] text-white shadow-md px-6 py-4 flex justify-end items-center">
                <!-- Rien ici si logo + utilisateur sont dans la sidebar -->
            </header>

            <!-- Contenu injecté -->
            <main class="flex-1 bg-[#070E2A] text-white p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>