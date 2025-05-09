<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - WebCinq</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out both;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .animate-gradient-move {
            animation: gradientMove 6s ease infinite;
        }
        @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    .logo-animate {
      animation: float 3s ease-in-out infinite;
    }
    </style>
</head>
<body class="antialiased min-h-screen bg-[#070E2A] text-white flex flex-col">

    <!-- En-tête -->
    <header class="w-full flex items-center justify-between p-6 bg-white shadow-md">
    <h1 class="text-2xl font-bold logo-animate">
            <span class="text-[#070E2A]">Web</span><span class="text-[#AC72A1]">Cinq</span>
            </h1>
        <div class="text-xl font-semibold text-[#070E2A] animate-fade-in-up">
            Gestion efficace, collaboration parfaite
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="flex flex-1 flex-col md:flex-row items-start justify-between px-10 py-8 space-y-10 md:space-y-0 md:space-x-10">

        <!-- Zone de texte d'accueil -->
        <div class="md:w-2/3 space-y-6 animate-fade-in-up">
            <h1 class="text-8xl md:text-8xl font-extrabold leading-tight bg-gradient-to-r from-white via-[#AC72A1] to-[#FBD9FA] text-transparent bg-clip-text animate-fade-in-up">
                <div>Optimisez la gestion</div>
                <div>de votre</div>
                <div>bureau </div>
            </h1>

            <div class="mt-10 space-x-4">
                <a href="{{ route('login') }}"
                   class="inline-block bg-[#AC72A1] hover:bg-[#FBD9FA] text-[#070E2A] font-bold text-lg px-8 py-4 rounded-xl shadow-lg transition transform hover:scale-105">
                    Se connecter
                </a>
                <a href="{{ route('register') }}"
                   class="inline-block bg-[#FBD9FA] hover:bg-[#AC72A1] text-[#070E2A] font-bold text-lg px-8 py-4 rounded-xl shadow-lg transition transform hover:scale-105">
                    S'inscrire
                </a>
            </div>
        </div>
        <div class="md:w-1/3 flex justify-center items-center animate-fade-in-up">
    <img src="{{ asset('images/ill.svg') }}" alt=" travail" class="w-full max-w-md">
</div>
       


    </main>

    <!-- Pied de page -->
    <footer class=" text-center w-full flex items-center justify-between p-6 bg-white shadow-md">
    <div class="text-xl font-semibold text-[#070E2A] animate-fade-in-up">
         © 2025 WebCinq - Tous droits réservés
        </div>
    </footer>
    @livewireScripts
</body>
</html>