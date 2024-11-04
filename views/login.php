<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dongeon Xplorer - Login Pop-up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen font-serif">

    <!-- Overlay Background -->
    <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-10">
        <!-- Popup Container -->
        <div class="bg-gray-800 text-gray-300 border-2 border-gray-600 rounded-lg shadow-xl p-6 w-full max-w-sm">
            <!-- Title -->
            <h2 class="text-3xl font-bold text-center text-yellow-500 mb-4">Dongeon Xplorer</h2>
            <p class="text-center text-sm text-gray-400 italic mb-6">Connexion à votre compte</p>

            <!-- Login Form -->
            <form action="login.php" method="POST" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-400 mb-1">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-1">Mot de passe :</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 mt-6 justify-center">
                    <button type="submit" class="bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded hover:bg-yellow-600 focus:outline-none">
                        Login
                    </button>
                    <button type="button" class="bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded hover:bg-gray-600 focus:outline-none" onclick="closeLogPopup()">
                        Cancel
                    </button>
                </div>
            </form>

            <!-- Subtitle or Decorative Text -->
            <p class="mt-8 text-center text-xs text-gray-400 tracking-widest">Account Login</p>
        </div>
    </div>
    <div class="text-center">
        <button onclick="openLogPopup()"
                class="relative inline-flex items-center px-8 py-3 font-bold text-gray-900 uppercase tracking-widest bg-yellow-500 border-2 border-yellow-600 rounded-lg shadow-md transform hover:scale-105 hover:bg-yellow-600 hover:text-yellow-100 focus:outline-none transition-all duration-200 ease-in-out">
            <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-yellow-500 to-yellow-700 opacity-20 rounded-lg transform -rotate-2"></span>
            <span class="relative z-10">Log in</span>
        </button>
    </div>
    <script>
        function closeLogPopup() {
            document.querySelector('.log').style.display = 'none';
        }
        function openLogPopup() {
            document.querySelector('.log').style.removeProperty('display');;
        }
    </script>
</body>
</html>
