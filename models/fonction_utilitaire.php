<?php
function rollDice($numberOfDice)
{
    $sum = 0;
    for ($i = 0; $i < $numberOfDice; $i++) {
        $result = rand(1, 6);
        $sum += $result;
    }
    return $result;
}
/*function rollDice($numberOfDice)
{
    $results = [];
    $sum = 0;

    for ($i = 0; $i < $numberOfDice; $i++) {
        $result = rand(1, 6);
        $results[] = $result; 
        $sum += $result; 
    }

    echo <<<HTML
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        <div id="popup" class="hidden fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold mb-4">Résultat des dés</h2>
                <div id="dice-container" class="flex justify-center space-x-4">
        HTML;

    foreach ($results as $index => $result) {
        echo <<<HTML
                <div id="die-$index" 
                     class="w-24 h-24 flex items-center justify-center text-4xl font-bold border-2 border-gray-300 rounded-md bg-gray-100 animate-spin">
                    <!-- Placeholder pour l'animation -->
                </div>
                <script>
                    setTimeout(() => {
                        const die = document.getElementById('die-$index');
                        die.classList.remove('animate-spin'); // Arrêter l'animation
                        die.textContent = $result; // Afficher le résultat
                    }, 1000 * ($index + 1)); // Décaler l'animation pour chaque dé
                </script>
            HTML;
    }

    echo <<<HTML
                </div>
                <p id="sum" class="mt-4 text-lg font-semibold hidden">Somme des résultats: $sum</p>
            </div>
        </div>
    <script>
        function openPopup() {
            document.getElementById('overlay').classList.remove('hidden');
            document.getElementById('popup').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('overlay').classList.add('hidden');
            document.getElementById('popup').classList.add('hidden');
        }

        // Ouvrir la pop-up au chargement
        openPopup();

        // Afficher la somme après la fin des animations
        setTimeout(() => {
            document.getElementById('sum').classList.remove('hidden');
        }, 1000 * $numberOfDice); // Attendre la fin des animations (1 seconde par dé)
        
        // Fermer la pop-up automatiquement après les animations et affichage de la somme
        setTimeout(() => {
            closePopup();
        }, 1000 * ($numberOfDice + 1)); // Attendre 1 seconde après le dernier résultat
    </script>
    HTML;
}*/
