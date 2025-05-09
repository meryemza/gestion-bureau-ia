<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .background-video {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .solid-overlay {
           
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .content-wrapper {
            z-index: 1;
        }
    </style>
</head>
<body class="font-sans text-white min-h-screen flex items-center justify-center relative">

    <!-- Vidéo de fond -->
    <video autoplay muted loop playsinline class="background-video">
        <source src="{{ asset('videos/WebCinq.mp4') }}" type="video/mp4">
        Votre navigateur ne supporte pas les vidéos HTML5.
    </video>

    <!-- Couche opaque par-dessus la vidéo -->
    <div class="solid-overlay"></div>

    <!-- Contenu -->
    <div class="content-wrapper w-full max-w-md p-6 rounded-2xl shadow-xl bg-[#070E2A]/90">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>