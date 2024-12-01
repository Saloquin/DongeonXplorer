<?php include_once('views/template/head.php')?>
<body class="bg-primary text-textMain font-body min-h-screen">
    <?php include_once('views/template/navbar.php')?>    
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