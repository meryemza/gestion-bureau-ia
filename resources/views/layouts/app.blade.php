<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard RH</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#070E2A] text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1A1F3B] p-6 hidden md:block">
            <h2 class="text-2xl font-bold mb-8">WebShield</h2>
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="block hover:text-pink-400">Dashboard</a>
                <a href="{{ route('employees.index') }}" class="block hover:text-pink-400">Employés</a>
                <a href="{{ route('conges.index') }}" class="block hover:text-pink-400">Congés</a>
                <a href="{{ route('salaire.index') }}" class="block hover:text-pink-400">Salaires</a>
                <a href="{{ route('projects.index') }}" class="block hover:text-pink-400">Projets</a>
                <!-- Ajoute d'autres liens ici -->
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
