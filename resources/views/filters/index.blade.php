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

        <!-- Vakantiewiel -->
        <div class="flex-grow flex items-center justify-center">
            <div class="bg-white w-full h-full max-w-4xl max-h-96 flex items-center justify-center rounded-lg shadow-md">
                <div id="wheelContainer">
                    <canvas id="wheelCanvas" width="500" height="500"></canvas>
                    <div id="marker"></div>
                </div>
                <div id="buttonContainer" class="mt-4">
                    <button id="spinButton" class="bg-blue-500 text-white py-2 px-4 rounded-md mr-2">Spin the Wheel</button>
                    <button id="filterButton" class="bg-green-500 text-white py-2 px-4 rounded-md">Apply Filter</button>
                </div>
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
                            value="{{ old('minPrice', 0) }}" readonly>
                        <input type="range" id="priceRange" name="priceRange" class="flex-grow" min="0" max="5000" step="50"
                            value="{{ old('priceRange', 2500) }}">
                        <input type="number" id="maxPrice" name="maxPrice" class="w-20 border-gray-300 rounded-md"
                            value="{{ old('maxPrice', 2500) }}" readonly>
                    </div>
                </div>

                <!-- Continentfilter -->
                <div class="mb-4">
                    <label for="continent" class="block font-medium">Continent</label>
                    <select id="continent" name="continent" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een continent --</option>
                        @foreach ($continents as $continent)
                            <option value="{{ $continent }}" @if (old('continent') == $continent) selected @endif>{{ $continent }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Klimaatfilter -->
                <div class="mb-4">
                    <label for="climate" class="block font-medium">Klimaat</label>
                    <select id="climate" name="climate" class="w-full border-gray-300 rounded-md">
                        <option value="">-- Kies een klimaat --</option>
                        @foreach ($climates as $climate)
                            <option value="{{ $climate }}" @if (old('climate') == $climate) selected @endif>{{ $climate }}</option>
                        @endforeach
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

    <!-- Vakantiebestemmingen -->
    <div class="mt-6">
        <h2 class="text-2xl font-bold mb-4">Vakantiebestemmingen</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($destinations as $destination)
                <div class="border rounded-lg p-4 shadow-md bg-white">
                    <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="rounded-md w-full h-32 object-cover mb-2">
                    <h3 class="text-lg font-bold">{{ $destination->name }}</h3>
                    <p class="text-sm">{{ $destination->description }}</p>
                    <p class="text-sm text-gray-500">Continent: {{ $destination->continent }}</p>
                    <p class="text-sm text-gray-500">Klimaat: {{ $destination->climate }}</p>
                    <p class="text-sm text-gray-500">Prijs: {{ $destination->price_category }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript voor de prijs-slider -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');
            const priceRange = document.getElementById('priceRange');

            minPriceInput.value = 0;
            maxPriceInput.value = priceRange.value;

            priceRange.addEventListener('input', function() {
                maxPriceInput.value = priceRange.value;
            });
        });
    </script>
</body>

</html>