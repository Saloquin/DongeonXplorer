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
                    <li>
                        <a href="register"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">S'inscrire</a>
                    </li>
                    <li>
                        <a href="login"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Se
                            connecter</a>
                    </li>
                    <li>
                        <a href="profil"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Taverne Section -->
    <?php
    require_once 'models/character/Player/Taverne.php';
    echo '<script>
        function openPopup(className) {
            const popup = document.getElementById(className);
            popup.classList.remove("hidden");
        }

        function closePopup(className) {
            const popup = document.getElementById(className);
            popup.classList.add("hidden");
        }
    </script>';

    $taverne = new Taverne();
    $classes = $taverne->getAllClasses();
    echo '<div class="flex flex-wrap justify-center gap-4">';
    foreach ($classes as $class) {
        echo '<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-2">';
        echo '<img class="rounded-t-lg object-cover h-48 w-full" src="' . $class->getImage() . '" alt="Image ' . $class->getName() . '" />';
        echo '<div class="p-5">';
        echo '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">' . $class->getName() . '</h5>';
        echo '<a href="#" onclick="openPopup(\'' . $class->getName() . '\')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    En savoir plus
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>';
        echo '</div>';
        echo '<div id="' . $class->getName() . '" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        
        <div class="bg-secondary p-5 rounded-lg shadow-lg max-w-md w-full">
            <button onclick="closePopup(\'' . $class->getName() . '\')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <h2 id="popupTitle" class="text-2xl font-bold mb-2"> ' . $class->getName() . '</h2>
            <img class="rounded-t-lg object-cover h-48 w-full" src="' . $class->getImage() . '" />
            <p id="popupDescription" class="mb-2">' . $class->getDescription() . '</p>
            <p id="popupHP" class="mb-2">Vie :' . $class->getBaseHealth() . '</p>
            <p id="popupMana" class="mb-2">Mana :' . $class->getMana() . '</p>
            <p id="popupStrenght" class="mb-2">Force :' . $class->getStrenght() . '</p>
            <p id="popupInitiative" class="mb-2">Vitesse :' . $class->getInitiative() . '</p>
            <p id="popupMaxItem" class="mb-2">Nombre item max :' . $class->getMaxItem() . '</p>
            <a href="#" onclick="closePopup(\'' . $class->getName() . '\')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Fermer
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
        </div>
    </div>
    </div>';
    }
    echo '</div>';
    ?>

    </main>

</body>

</html>