<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waar ga jij op reis?</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 font-sans min-h-screen text-white">

    <!-- Top Bar met achtergrondkleur -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-black bg-opacity-75 py-4">
        <div class="container mx-auto flex items-center justify-between px-4">
            <!-- Logo -->
            <div class="text-white font-bold text-xl mr-8">
                <a href="#" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 object-contain">
                </a>
            </div>

            <!-- Navigatie Knoppen -->
            <div class="space-x-8">
                <a href="#" class="text-white hover:text-blue-400">Home</a>
                <a href="#" class="text-white hover:text-blue-400">Rad</a>
                <a href="#" class="text-white hover:text-blue-400">Account</a>
            </div>
        </div>
    </div>

    <!-- Main Content met achtergrond -->
    <div class="relative z-10 pt-32 pb-32">

        <!-- Background image (Blurry & Inzoomen) -->
        <div class="absolute inset-0 -z-10 bg-cover bg-center blur-sm" style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center; height: 100vh;"></div>

        <!-- Main content container, gecentreerd -->
        <div class="relative z-20 container mx-auto px-4 flex flex-col items-center justify-center h-full text-center">

            <!-- Header -->
            <header class="mb-10">
                <h1 class="text-4xl font-bold text-blue-600">Waar ga jij op reis?</h1>
            </header>

            <!-- Content -->
            <div class="flex flex-col sm:flex-row items-center justify-center sm:space-x-8">
                <!-- Left Side (Knop en Titel) -->
                <div class="w-full sm:w-1/2 space-y-4 mb-8 sm:mb-0">
                    <a href="#" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-500">
                        Ontdek je bestemming
                    </a>
                    <h2 class="text-xl font-medium">Vind jouw perfecte vakantieplek</h2>
                </div>

                <!-- Right Side (Beschrijving) -->
                <div class="w-full sm:w-1/2 pl-8">
                    <p class="text-lg leading-relaxed">
                        Wil je een ontspannende vakantie of een avontuur? Wij helpen je bij het vinden van de beste bestemmingen op basis van jouw voorkeuren.
                    </p>
                </div>
            </div>

            <!-- Grote knop "Draai het rad" -->
            <div class="mt-10">
                <a href="#" class="inline-block bg-green-600 text-white px-12 py-4 rounded-full text-2xl font-bold hover:bg-green-500">
                    Draai het rad
                </a>
            </div>
        </div>
    </div>

</body>

</html>
