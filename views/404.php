<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<body class="bg-primary text-textMain font-body min-h-screen bg-[url('Images/background/404.jpg')] bg-cover">
    <nav class="bg-navbarDark border-gray-200">
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
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-navbarDark">
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
    <div class="flex flex-col items-center justify-center min-h-screen ">
        <h1 class="bg-primary p-5"> Erreur 404 : page non trouvé </h1>
        <h2 class="bg-primary p-5">Je crois que tu t'es trompé de chemin.</h2>
    </div>

</body>

</html>