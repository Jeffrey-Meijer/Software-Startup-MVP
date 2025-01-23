<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl mb-4">Voeg een nieuwe bestemming toe</h2>

                    <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Naam van de bestemming -->
                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bestemmingsnaam</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>

                        <!-- Prijscategorie -->
                        <div class="mb-4">
                            <label for="price_category"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prijscategorie</label>
                            <select name="price_category" id="price_category"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                                <option value="Budget">Budget</option>
                                <option value="Gemiddeld">Gemiddeld</option>
                                <option value="Luxueus">Luxueus</option>
                            </select>
                        </div>

                        <!-- Continent -->
                        <div class="mb-4">
                            <label for="continent"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Continent</label>
                            <select name="continent" id="continent"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                                <option value="Europa">Europa</option>
                                <option value="Azië">Azië</option>
                                <option value="Afrika">Afrika</option>
                                <option value="Noord-Amerika">Noord-Amerika</option>
                                <option value="Zuid-Amerika">Zuid-Amerika</option>
                                <option value="Oceanië">Oceanië</option>
                            </select>
                        </div>

                        <!-- Klimaat -->
                        <div class="mb-4">
                            <label for="climate"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Klimaat</label>
                            <select name="climate" id="climate"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                                <option value="Tropisch">Tropisch</option>
                                <option value="Gematigd">Gematigd</option>
                                <option value="Koud">Koud</option>
                            </select>
                        </div>

                        <!-- Beschrijving -->
                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Beschrijving</label>
                            <textarea name="description" id="description"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"></textarea>
                        </div>

                        <!-- Afbeelding URL -->
                        <div class="mb-4">
                            <label for="image_url"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Afbeelding
                                URL</label>
                            <input type="text" name="image_url" id="image_url"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <button type="submit"
                            class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500">Voeg
                            bestemming toe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tweede formulier: Voeg een nieuw reisbureau toe -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl mb-4">Voeg een nieuw reisbureau toe</h2>

                    <form action="{{ route('travel-agency.store') }}" method="POST">
                        @csrf

                        <!-- Naam van het reisbureau -->
                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reisbureau
                                Naam</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>

                        <!-- Telefoonnummer -->
                        <div class="mb-4">
                            <label for="phone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefoonnummer</label>
                            <input type="text" name="phone" id="phone"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>

                        <!-- E-mailadres -->
                        <div class="mb-4">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mailadres</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>

                        <!-- Selecteer bestemming -->
                        <div class="mb-4">
                            <label for="destination_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Koppel aan
                                Bestemming</label>
                        <select name="destination_id" id="destination_id"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                            required>
                            <option value="">Selecteer een bestemming</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->destination_id }}">{{ $destination->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <!-- Prijs -->
                        <div class="mb-4">
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prijs</label>
                            <input type="number" name="price" id="price" step="0.01" min="0"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>

                        <button type="submit"
                            class="mt-4 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500">
                            Voeg reisbureau toe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif
</x-app-layout>