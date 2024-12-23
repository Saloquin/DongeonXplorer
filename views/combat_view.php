<?php include_once('views/template/head.php') ?>

<body class="bg-primary text-textMain font-body min-h-screen">
    <?php
    include_once('views/template/navbar.php');
    include_once('models/character/monster/Monster.php');
    echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>";
    $user = new User($_SESSION['user']);
    $hero = $user->getHero();
    $chapter = new Chapter($user->getHero()->getChapter());
    $monster_id = lireBase(connexionDb(), "SELECT monster_id FROM monster JOIN encounter USING (encounter_id) WHERE chapter_id=" . $chapter->getId())[0]['monster_id'];
    $monster = new Monster($monster_id);

    $combat = lireBase(connexionDb(), "SELECT monster_pv,monster_mana FROM combat WHERE hero_id = " . $user->getHero()->getHeroId() . " AND chapter_id=" . $user->getHero()->getChapter() . " and  ongoing = 1");


    $monster->setPv($combat[0]['monster_pv']);
    $monster->setMana($combat[0]['monster_mana']);


    ?>
    <h1 class="text-4xl md:text-5xl font-bold text-center mb-6">
        <?php echo htmlspecialchars($chapter->getTitle()); ?>
    </h1>

    <!-- Description -->
    <p class="text-lg md:text-xl mb-6">
        <?php echo nl2br(htmlspecialchars($chapter->getDescription())); ?>
    </p>
    <!-- Conteneur principal -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-screen p-6">
        <!-- Section gauche : Menu de combat -->
        <div class="bg-secondary p-4 rounded-lg">
            <div class="hero-section">
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-6">
                    <?php echo htmlspecialchars($hero->getName()); ?>
                </h1>
                <?php
                $HerocurrentPv =$hero->getPv();
                $HeromaxPv = $hero->getPvMax();
                $heroDamage = isset($_SESSION['heroDamage']) ? $_SESSION['heroDamage'] : 0;
                $heroOldPv = $HerocurrentPv + $heroDamage;
                $HerohealthPercentageOld = ($HeromaxPv > 0) ? ($heroOldPv / $HeromaxPv) * 100 : 0;
                $HerohealthPercentageCurrent = ($HeromaxPv > 0) ? ($HerocurrentPv / $HeromaxPv) * 100 : 0;


                $HerocurrentMana = $hero->getMana();
                $HeromaxMana = $hero->getManaMax();
                $heroManaCost = isset($_SESSION['spellCost']) ? $_SESSION['spellCost'] : 0;
                $heroOldMana = $HerocurrentMana + $heroManaCost;

                $HeromanaPercentageOld = ($HeromaxMana > 0) ? ($heroOldMana / $HeromaxMana) * 100 : 0;
                $HeromanaPercentageCurrent = ($HeromaxMana > 0) ? ($HerocurrentMana / $HeromaxMana) * 100 : 0;
                ?>
                <!-- Barre de vie -->
                <div class="w-full bg-gray-300 rounded-lg h-6 mb-2">
                    <div id="hero-health-bar" class="bg-red-600 h-6 rounded-lg" style="width: <?php echo $HerohealthPercentageOld; ?>%;"></div>
                </div>
                <p class="text-center text-lg font-semibold" id="hero-health">
                    <?php echo $heroOldPv . " / " . $HeromaxPv . " PV"; ?>
                </p>

                <!-- Barre de mana -->
                <div class="w-full bg-gray-300 rounded-lg h-6 mt-2">
                    <div class="bg-blue-600 h-6 rounded-lg"  id="hero-mana-bar" style="width: <?php echo $HeromanaPercentageOld; ?>%;"></div>
                </div>
                <p class="text-center text-lg font-semibold">
                    <?php echo $HerocurrentMana . " / " . $HeromaxMana . " Mana"; ?>
                </p>
                <div id="hero-image-container" class="w-full h-auto rounded-lg mb-4 items-center flex justify-center">
                <img src="<?php echo htmlspecialchars($user->getImage()); ?>" alt="Image du héro" id="hero-image"
                class="w-full h-auto rounded-lg mb-4 max-w-xl max-h-xl">
                <div id="hero-damage-text" class="damage-text"></div>
                </div>
            </div>
            <?php if ($monster->isAlive() and $hero->isAlive()): ?>
            <div class="actions grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                <form method="POST" action="attack" class="w-full">
                    <button type="submit" id="attack-button"
                        class="btn-combat bg-green-600 hover:bg-green-700 active:bg-green-800 text-white py-3 px-8 rounded-lg font-semibold shadow-md transform transition duration-300 hover:scale-105 w-full">
                        Attaquer
                    </button>
                </form>

                <?php foreach ($hero->getSpellList() as $spell): ?>
                    <form method="POST" action="cast_spell" class="relative group w-full" >
                        <button id="spell-button" type="submit" name="spell_id" value="<?php echo $spell->getId(); ?>"
                            class="btn-combat bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white py-3 px-8 rounded-lg font-semibold shadow-md transform transition duration-300 hover:scale-105 w-full">
                            Utiliser <?php echo htmlspecialchars($spell->getName()); ?>
                        </button>

                        <!-- Tooltip avec description du sort, visible uniquement au survol -->
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 text-center z-10">
                            <?php echo "<p>".htmlspecialchars($spell->getDescription())."</p>"; 
                                echo "<p>"."Coût en Mana : ".htmlspecialchars($spell->getManaCost())."</p>";
                            ?>
                        </div>
                    </form>
                <?php endforeach; ?>
                <form method="POST" action="use_item" class="w-full">
                        <button type="button" onclick="openConsumablesPopup()"
                            class="btn-combat bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white py-3 px-8 rounded-lg font-semibold shadow-md transform transition duration-300 hover:scale-105 w-full">
                            Utiliser Consommable
                        </button>
                    </form>

                    <div id="consumablesPopup"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-300 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3">
                            <h2 class="text-2xl font-bold mb-4">Consommables</h2>
                            <div class="grid grid-cols-1 gap-4">
                                <?php foreach ($hero->getInventory()->getConsommables() as $item): ?>
                                    <form method="POST" action="use_item" class="relative group w-full">
                                        <button type="submit" name="item_id" value="<?php echo $item['item']->getItemId(); ?>"
                                            class="btn-consumable bg-green-600 hover:bg-green-700 active:bg-green-800 text-white py-2 px-4 rounded-lg font-semibold shadow-md w-full relative">
                                            <?php echo htmlspecialchars($item['item']->getName()); ?>
                                            :
                                            <?php echo htmlspecialchars($item['quantity']); ?>
                                            <!-- Tooltip avec description -->
                                            <span
                                                class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 hidden group-hover:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 text-center z-10 shadow-lg">
                                                <?php echo htmlspecialchars($item['item']->getDescription()); ?>
                                            </span>
                                        </button>
                                    </form>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" onclick="closeConsumablesPopup()"
                                class="mt-4 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white py-2 px-4 rounded-lg font-semibold shadow-md">
                                Fermer
                            </button>
                        </div>
                    </div>


                    <script>
                        function openConsumablesPopup() {
                            const popup = document.getElementById('consumablesPopup');
                            popup.classList.remove('hidden');
                        }

                        function closeConsumablesPopup() {
                            const popup = document.getElementById('consumablesPopup');
                            popup.classList.add('hidden');
                        }
                    </script>
            </div>
            <?php endif; ?>



        </div>

        <!-- Section droite : Monstre -->
        <div class="bg-secondary p-4 rounded-lg">
            <!-- Titre -->
            <?php if ($monster->isAlive() and $hero->isAlive()): ?>
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-6">
                    <?php echo htmlspecialchars($monster->getName()); ?>
                </h1>

                <!-- Image et barre de vie -->
                <div class="w-full max-w-md mx-auto">
                    <?php

                    $monsterMaxPv = $monster->getPvMax();
                    $monsterDamage = isset($_SESSION['monsterDamage']) ? $_SESSION['monsterDamage'] : 0;
                    $monsterOldPv = $monster->getPv() + $monsterDamage;
                    $monsterCurrentPv = $monster->getPv();
                    $monsterHealthPercentageOld = ($monsterMaxPv > 0) ? ($monsterOldPv / $monsterMaxPv) * 100 : 0;
                    $monsterHealthPercentage = ($monsterMaxPv > 0) ? ($monsterCurrentPv / $monsterMaxPv) * 100 : 0;
                    ?>
                    <div class="w-full bg-gray-300 rounded-lg h-6">
                        <div class="bg-red-600 h-6 rounded-lg"  id="monster-health-bar" style="width: <?php echo $monsterHealthPercentageOld; ?>%;"></div>
                    </div>
                    <p class="text-center mt-2 text-lg font-semibold">
                        <?php echo $monsterCurrentPv . " / " . $monsterMaxPv . " PV"; ?>
                    </p>
                    <div id="monster-image-container" class="w-full h-auto rounded-lg mb-4 items-center flex justify-center">
                    <img src="<?php echo htmlspecialchars($monster->getImage()); ?>" alt="Image du monstre" id="monster-image"
                    class="w-full h-auto rounded-lg mb-4 max-w-xl max-h-xl">
                    <div id="monster-damage-text" class="damage-text"></div>
                </div>

                </div>
            <?php else: ?>
                <?php
                foreach ($chapter->getChoices() as $choice) {
                    if ($choice['victory'] == 1) {
                        $victory = $choice;
                    } else {
                        $defeat = $choice;
                    }

                }

                ?>
                <?php if (!$hero->isAlive()): ?>
                    <p>Vous êtes mort !</p>
                    <form method="post" action="chapter">
                        <input type="hidden" name="end_combat" value="1" >
                        <button type="submit" name="chapter_id" value="<?php echo $defeat['chapter_id']; ?>"
                            class="btn btn-primary px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            <?php echo $defeat['link_description']; ?>
                        </button>
                    </form>
                <?php elseif (!$monster->isAlive()): ?>
                    <p>Vous avez vaincu le monstre !</p>
                    <p>Appuyer sur le bouton pour sauvegarder et continuer votre Quêtes</p>
                    <form method="post" action="chapter">
                        <input type="hidden" name="xp" value="<?php echo htmlspecialchars($monster->getExperienceValue()); ?>">
                        <input type="hidden" name="loot" value="<?php $loot = $monster->getLoot();?>">
                        <input type="hidden" name="end_combat" value="1"> 

                        <?php
                        if ($loot)
                            echo htmlspecialchars($monster->getLoot()); ?>
                        <button type="submit" name="chapter_id" value="<?php echo $victory['chapter_id']; ?>"
                            class="btn btn-primary px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            <?php echo $victory['link_description']; ?>
                        </button>
                    </form>
                    <?php if ($monster->getExperienceValue() > 0)
                        echo "<p>Vous avez gagné " . $monster->getExperienceValue() . " points d'expérience !</p>"
                            ?>
                        <?php
                    $loot = $monster->getLoot();
                    if ($loot) {
                        $tab = lireBase(connexionDb(), "select item_name from item join loot using (item_id) where loot_id=" . $loot);
                        echo "<p>Vous avez trouver " . $tab[0]["item_name"] . " </p>";
                    }
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</body>

<style>
@keyframes vibrate {
    0% { transform: translate(0); }
    25% { transform: translate(-20px, 20px); }
    50% { transform: translate(20px, -20px); }
    75% { transform: translate(-20px, -20px); }
    100% { transform: translate(20px, 20px); }
}

.vibrate {
    animation: vibrate 0.2s linear infinite;
}

@keyframes decreaseHealth {
    from { width: <?php echo $HerohealthPercentageOld; ?>%; }
    to { width: <?php echo $HerohealthPercentageCurrent; ?>%; }
}

.decrease-health {
    animation: decreaseHealth 1s forwards;
}

@keyframes decreaseMana {
    from { width: <?php echo $HeromanaPercentageOld; ?>%; }
    to { width: <?php echo $HeromanaPercentageCurrent; ?>%; }
}

.decrease-mana {
    animation: decreaseMana 1s forwards;
}

@keyframes decreaseMonsterHealth {
    from { width: <?php echo $monsterHealthPercentageOld; ?>%; }
    to { width: <?php echo $monsterHealthPercentage; ?>%; }
}

.decrease-monster-health {
    animation: decreaseMonsterHealth 1s forwards;
}

.damage-text {
    color: red;
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 8px;
}

.fade-out {
    animation: fadeOut 1s ease-out forwards;
}

@keyframes fadeOut {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-20px); }
}

</style>

<script>

function displayDamage(damageText, targetId) {
   const damageElement = document.getElementById(targetId);

    // Affiche le texte des dégâts
    damageElement.textContent = `-${damageText}`;
    damageElement.style.display = "block";
    damageElement.classList.add("fade-out");

    // Réinitialise une fois l'animation terminée
    damageElement.addEventListener('animationend', () => {
        damageElement.style.display = "none";
        damageElement.textContent = "";
        damageElement.classList.remove("fade-out");
    }, { once: true });
}
function onMonsterDamage() {
    const monsterImage = document.getElementById('monster-image');
    monsterImage.classList.add('vibrate');
    displayDamage(<?php echo $monsterDamage; ?>, 'monster-damage-text');

    setTimeout(() => {
        monsterImage.classList.remove('vibrate');
    }, 1000); // Adjust the duration as needed
}

function onHeroDamage() {
    const heroImage = document.getElementById('hero-image');
    heroImage.classList.add('vibrate');
    displayDamage(<?php echo $heroDamage; ?>, 'hero-damage-text');
    setTimeout(() => {
        heroImage.classList.remove('vibrate');
    }, 1000); // Adjust the duration as needed
}


document.addEventListener('DOMContentLoaded', (event) => {
    <?php if (isset($_SESSION['monsterDamage']) && $_SESSION['monsterDamage'] != 0): ?>
    const monsterHealthBar = document.getElementById('monster-health-bar');
    monsterHealthBar.classList.add('decrease-monster-health');

    <?php if (isset($_SESSION['spellCost']) && $_SESSION['spellCost'] != 0): ?>
        const heroManaBar = document.getElementById('hero-mana-bar');
        console.log(heroManaBar);
        heroManaBar.classList.add('decrease-mana');
    <?php endif; ?>
    onMonsterDamage();
    <?php endif; ?>

    <?php if (isset($_SESSION['heroDamage']) && $_SESSION['heroDamage'] != 0): ?>
    setTimeout(() => {
        const heroHealthBar = document.getElementById('hero-health-bar');
        heroHealthBar.classList.add('decrease-health');
        onHeroDamage();
        const heroHealth = document.getElementById('hero-health');
        heroHealth.textContent = '<?php echo $HerocurrentPv . " / " . $HeromaxPv . " PV"; ?>';
    }, 2000);
    <?php endif; ?>

    <?php
    unset($_SESSION['heroDamage']);
    unset($_SESSION['monsterDamage']);
    unset($_SESSION['spellCost']);
    ?>
});
</script>
</html>