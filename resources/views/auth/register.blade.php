<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription - Réservation de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .background-image {
            background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="background-image font-sans">
    <div class="flex h-screen">
        <div class="m-auto bg-white p-8 rounded-lg shadow-lg w-full max-w-md opacity-90">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Inscription</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Form Fields -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nom:</label>
                    <input type="text" id="name" name="name" required class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="name">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" required class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="email">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Mot de passe:</label>
                    <input type="password" id="password" name="password" required class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="new-password">
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700">Confirmez le mot de passe:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="new-password">
                </div>
                <div class="mb-6">
                    

<fieldset>
  <legend class="sr-only">Countries</legend>

  <div class="flex items-center mb-4">
    <input id="country-option-1" type="radio" name="role" value="USA" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
    <label for="role_Organisateur" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
      Organisateur
    </label>
  </div>

  <div class="flex items-center mb-4">
    <input id="country-option-2" type="radio" name="role" value="Germany" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
    <label for="country-spèctateur" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
    spèctateur
    </label>
  </div>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg font-semibold hover:bg-blue-600">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
</html>
