<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    
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
            <h2 class="text-xl font-bold mb-4">
                @php
                    $role = Auth::user()->role;
                    $roleTitles = [
                        'admin' => 'Admin Dashboard',
                        'rh' => 'RH Dashboard',
                        'comptable' => 'Comptable Dashboard',
                        'employe' => 'Employé Dashboard',
                        'auditeur' => 'Auditeur Dashboard',
                    ];
                @endphp
                {{ $roleTitles[$role] ?? 'Dashboard' }}
            </h2>
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
                @switch($role)
                    @case('admin')
                        <a href="{{ route('dashboard.admin') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                        <a href="{{ route('admin.membres.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-users"></i> Membres
                        </a>
                        <a href="{{ route('admin.projets.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-project-diagram"></i> Projets
                        </a>
                        <a href="{{ route('admin.clients.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-user-tie"></i> Clients
                        </a>
                        <a href="{{ route('admin.factures.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-file-invoice"></i> Factures
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-cogs"></i> Services & Tarifs
                        </a>
                        <a href="{{ route('admin.salaires.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-dollar-sign"></i> Salaires
                        </a>
                        <a href="{{ route('admin.conges.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-calendar-day"></i> Congés
                        </a>
                        <a href="{{ route('admin.depenses.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-wallet"></i> Dépenses
                        </a>
                        @break
                    @case('comptable')
                        <a href="{{ route('dashboard.comptable') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                        <a href="{{ route('factures.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-file-invoice"></i> Factures
                        </a>
                        <a href="{{ route('depenses.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-dollar-sign"></i> Dépenses
                        </a>
                        <a href="{{ route('fournisseurs.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-truck"></i> Fournisseurs
                        </a>
                        <a href="{{ route('paiements.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-credit-card"></i> Paiements
                        </a>
                        @break
                    @case('employe')
                        <a href="{{ route('dashboard.employe') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                        <a href="{{ route('admin.projets.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-project-diagram"></i> Projets
                        </a>
                        <a href="{{ route('depenses.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-dollar-sign"></i> Dépenses
                        </a>
                        <a href="#" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-money-bill-wave"></i> Salaire
                        </a>
                        <a href="{{ route('employe.mes_conges') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-calendar-check"></i> Statut de mes demandes
                        </a>
                        @break
                    @case('rh')
                        <a href="{{ route('rh.dashboard') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                        <a href="{{ route('rh.absences.create') }}" class="flex items-center gap-3 hover:underline {{ request()->routeIs('rh.absences.*') ? 'underline font-bold' : '' }}">
                            <i class="fas fa-calendar-day"></i> Absences
                        </a>
                        <a href="{{ route('rh.contrats.index') }}" class="flex items-center gap-3 hover:underline {{ request()->routeIs('rh.contrats.*') ? 'underline font-bold' : '' }}">
                            <i class="fas fa-file-alt"></i> Contrats
                        </a>
                        <a href="{{ route('rh.salaires.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-dollar-sign"></i> Salaires
                        </a>
                        <a href="{{ route('rh.recrutement.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-users"></i> Recrutements
                        </a>
                        @break
                    @case('auditeur')
                        <a href="{{ route('auditeur.dashboard') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                        <a href="{{ route('auditeur.security-audits.index') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-shield-alt"></i> Audits de sécurité
                        </a>
                        <a href="{{ route('auditeur.security-audits.create') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-plus"></i> Nouvel audit
                        </a>
                        @break
                    @default
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 hover:underline">
                            <i class="fas fa-tachometer-alt"></i> Tableau de bord
                        </a>
                @endswitch

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