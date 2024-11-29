<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dongeon Xplorer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/DongeonXplorer/Images/icon/Logo.ico" type="image/x-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1A1A1A',
                        secondary: '#2E2E2E',
                        navbarDark: '#1C1C1C',
                        textMain: '#E5E5E5',
                        textSecondary: '#BFBFBF',
                        accentGold: '#C4975E',
                        accentRed: '#8B1E1E',
                        accentGreen: '#4A7A66',
                    },
                    fontFamily: {
                        title: ['"Pirata One"', 'cursive'],
                        body: ['Roboto', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-primary flex items-center justify-center h-screen font-body">
    <nav class="bg-navbarDark border-gray-200 z-20 w-full fixed top-0 left-0"> <!-- w-full et fixed en haut -->
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="home" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="/DongeonXplorer/Images/icon/Logo.png" class="h-8" alt="Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">DungeonXplorer</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border  rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-navbarDark">
                    <?php if (!isset($_SESSION['user'])): ?>
                        <li>
                            <a href="register"
                                class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">S'inscrire</a>
                        </li>
                        <li>
                            <a href="login"
                                class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Se
                                connecter</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="profil"
                                class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Profil</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Overlay Background -->

    <!-- Popup Container -->
    <div class="bg-primary text-gray-300 border-2 border-gray-600 rounded-lg shadow-xl p-6 w-full max-w-sm">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-center text-yellow-500 mb-4">Dongeon Xplorer</h2>
        <p class="text-center text-sm text-gray-400 italic mb-6">Créer un compte pour commencer votre aventure</p>
        <p class="text-center text-sm text-red-400 italic mb-6">
            <?php if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            } ?>
        </p>

        <!-- Registration Form -->
        <form action="register" method="POST" class="space-y-4">
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
                <button type="submit"
                    class="bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded hover:bg-yellow-600 focus:outline-none">
                    S'inscrire
                </button>
                <button type="button"
                    class="bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded hover:bg-gray-600 focus:outline-none">
                    Annuler
                </button>
            </div>
        </form>

        <!-- Subtitle or Decorative Text -->
        <p class="mt-8 text-center text-xs text-gray-400 tracking-widest">Création du compte</p>
    </div>


</body>

</html>