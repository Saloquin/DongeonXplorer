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
    <title>Dungeon Xplorer</title>
</head>

<body class="bg-primary text-textMain font-body min-h-screen">

    <!-- Navbar -->
    <nav class="bg-navbarDark border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="home" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="/DongeonXplorer/Images/icon/Logo.png" class="h-8" alt="Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">DungeonXplorer</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-navbarDark">
                    <li>
                        <a href="register" class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">S'inscrire</a>
                    </li>
                    <li>
                        <a href="login" class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Se connecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-secondary p-8 rounded-lg shadow-lg w-full max-w-4xl mx-auto mt-8">
        <h1 class="text-4xl font-title text-accentGold mb-4 text-center">Bienvenue sur DungeonXplorer</h1>
        <p class="text-lg mb-4">
            Bienvenue sur DungeonXplorer, l'univers de dark fantasy où se mêlent aventure, stratégie et immersion
            totale dans les récits interactifs.
        </p>
        <p class="text-textSecondary mb-4">
            Ce projet est né de la volonté de l’association Les Aventuriers du Val Perdu de raviver l’expérience unique
            des livres dont vous êtes le héros. Notre vision : offrir à la communauté un espace où chacun peut incarner
            un personnage et plonger dans des quêtes épiques et personnalisées.
        </p>
        <p class="text-textSecondary mb-4">
            Dans sa première version, DungeonXplorer permettra aux joueurs de créer un personnage parmi trois
            classes emblématiques — guerrier, voleur, magicien — et d’évoluer dans un scénario captivant, tout en
            assurant à chacun la possibilité de conserver sa progression.
        </p>
        <p class="text-textSecondary mb-4">
            Nous sommes enthousiastes de partager avec vous cette application et espérons qu'elle saura vous plonger
            au cœur des mystères du Val Perdu !
        </p>
        <div class="flex justify-center">
            <a href="player_selection" class="bg-accentGreen hover:bg-accentGold text-textMain py-2 px-4 rounded text-center">
                Commencer l'Aventure
            </a>
        </div>

    </main>
</body>

</html>