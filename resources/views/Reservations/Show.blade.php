<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Événement</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-green-100">
    <div class="container mx-auto p-8">
        <div class="bg-white rounded-lg shadow-xl">
            <!-- Section image -->
            <div class="w-full h-64 md:h-96 bg-cover bg-center rounded-t-lg" style="background-image: url('{{ $event->getFirstMediaUrl('eventImage') }}')"></div>

            <!-- Affichage du message de succès dans une carte stylisée -->
            @if (session('success'))
            <div class="mx-auto w-3/4 bg-green-200 text-green-800 text-center py-4 rounded-md shadow-md my-4">
                {{ session('success') }}
            </div>
            @endif

            <!-- Détails de l'événement -->
            <div class="p-6 md:p-12">
                <div class="text-center">
                    <h2 class="text-4xl font-extrabold text-gray-800 sm:text-5xl md:text-6xl">{{ $event->titre }}</h2>
                    <h3 class="text-xl md:text-2xl mt-4 text-gray-600">{{ $event->date }}</h3>
                    <p class="text-md md:text-lg mt-6 text-gray-700">{{ $event->description }}</p>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="px-4 py-2 bg-green-100 rounded-lg shadow-inner">
                        <span class="text-gray-700 font-semibold">Lieu:</span>
                        <p class="text-gray-800">{{ $event->lieux }}</p>
                    </div>
                    <div class="px-4 py-2 bg-green-100 rounded-lg shadow-inner">
                        <span class="text-gray-700 font-semibold">Catégorie:</span>
                        <p class="text-gray-800">{{ $event->categorie->name }}</p>
                    </div>
                    <div class="px-4 py-2 bg-green-100 rounded-lg shadow-inner">
                        <span class="text-gray-700 font-semibold">Places disponibles:</span>
                        <p class="text-gray-800">{{ $event->place }}</p>
                    </div>
                </div>

                <!-- Formulaire de réservation -->
                <div class="mt-12 text-center">
                <form action="{{ route('reservation', $event->id) }}" method="POST" class="w-full max-w-sm mx-auto">
    @csrf
    <div class="mb-4">
        <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Réserver des places :</label>
        <input id="quantity" type="number" value="1" name="quantity" min="1" class="border border-gray-300 text-center py-2 px-4 rounded focus:outline-none focus:shadow-outline" />
    </div>
    <input type="hidden" name="auto" value="{{ $event->auto }}" />
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Réserver
    </button>
</form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
