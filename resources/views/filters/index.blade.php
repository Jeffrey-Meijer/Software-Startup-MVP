<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filters</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-6 flex h-screen">
    {{-- @include('layouts.navigation') --}}
    <div class="flex w-full h-full">

        <!-- Ruimte voor het rad -->
        <div class="flex-grow flex items-center justify-center">
            <div class="bg-white w-full h-full max-w-4xl max-h-96 flex items-center justify-center rounded-lg shadow-md">
                <p class="text-gray-500">Hier komt straks het rad!</p>
            </div>
        </div>

        <!-- Filters -->
        <aside class="w-1/4 bg-white p-6 shadow-md rounded-lg ml-4">
            <h1 class="text-xl font-bold mb-4">Vakantiebestemming Filters</h1>

            <form method="POST" action="{{ route('filters.filter') }}">
                @csrf

                <!-- Prijsfilter -->
                <div class="mb-4">
                    <label for="price" class="block font-medium">Prijs Range (€)</label>
                    <div class="flex items-center space-x-4">
                        <input type="number" id="minPrice" name="minPrice" class="w-20 border-gray-300 rounded-md"
                            readonly>
                        <input type="range" id="priceRange" name="priceRange" class="flex-grow" min="0"
                            max="5000" step="50" value="2500">
                        <input type="number" id="maxPrice" name="maxPrice" class="w-20 border-gray-300 rounded-md"
                            readonly>
                    </div>
                </div>

                <!-- Continentfilter -->
                <div class="mb-4">
                    <label for="continent" class="block font-medium">Continent</label>
                    <select id="continent" name="continent" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een continent --</option>
                        @foreach ($continents as $continent)
                            <option value="{{ $continent }}">{{ $continent }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Klimaatfilter -->
                <div class="mb-4">
                    <label for="climate" class="block font-medium">Klimaat</label>
                    <select id="climate" name="climate" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een klimaat --</option>
                        <option value="winter">Winter</option>
                        <option value="zomer">Zomer</option>
                        <option value="lente">Lente</option>
                        <option value="herfst">Herfst</option>
                        <option value="tropisch">Tropisch</option>
                        <option value="koud">Koud</option>
                    </select>
                </div>

                <!-- Filter knop -->
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Filter toepassen</button>
            </form>

            @if (session('success'))
                <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </aside>
    </div>

    <!-- JavaScript voor de prijs-slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');
            const priceRange = document.getElementById('priceRange');

            // Stel initiële waarden in
            minPriceInput.value = 0;
            maxPriceInput.value = priceRange.value;

            // Update maximumwaarde op slepen
            priceRange.addEventListener('input', function() {
                maxPriceInput.value = priceRange.value;
            });
        });
    </script>
</body>

</html>
