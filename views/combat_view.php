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
                $HerocurrentPv = $hero->getPv();
                $HeromaxPv = $hero->getPvMax();
                $HerohealthPercentage = ($HeromaxPv > 0) ? ($HerocurrentPv / $HeromaxPv) * 100 : 0;

                $HerocurrentMana = $hero->getMana();
                $HeromaxMana = $hero->getManaMax();
                $HeromanaPercentage = ($HeromaxMana > 0) ? ($HerocurrentMana / $HeromaxMana) * 100 : 0;
                ?>
                <!-- Barre de vie -->
                <div class="w-full bg-gray-300 rounded-lg h-6 mb-2">
                    <div class="bg-red-600 h-6 rounded-lg" style="width: <?php echo $HerohealthPercentage; ?>%;"></div>
                </div>
                <p class="text-center text-lg font-semibold">
                    <?php echo $HerocurrentPv . " / " . $HeromaxPv . " PV"; ?>
                </p>

                <!-- Barre de mana -->
                <div class="w-full bg-gray-300 rounded-lg h-6 mt-2">
                    <div class="bg-blue-600 h-6 rounded-lg" style="width: <?php echo $HeromanaPercentage; ?>%;"></div>
                </div>
                <p class="text-center text-lg font-semibold">
                    <?php echo $HerocurrentMana . " / " . $HeromaxMana . " Mana"; ?>
                </p>
            </div>

            <div class="actions grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                <form method="POST" action="attack" class="w-full">
                    <button type="submit"
                        class="btn-combat bg-green-600 hover:bg-green-700 active:bg-green-800 text-white py-3 px-8 rounded-lg font-semibold shadow-md transform transition duration-300 hover:scale-105 w-full">
                        Attaquer
                    </button>
                </form>

                <?php foreach ($hero->getSpellList() as $spell): ?>
                    <form method="POST" action="cast_spell" class="relative group w-full">
                        <button type="submit" name="spell_id" value="<?php echo $spell->getId(); ?>"
                            class="btn-combat bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white py-3 px-8 rounded-lg font-semibold shadow-md transform transition duration-300 hover:scale-105 w-full">
                            Utiliser <?php echo htmlspecialchars($spell->getName()); ?>
                        </button>

                        <!-- Tooltip avec description du sort, visible uniquement au survol -->
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 text-center z-10">
                            <?php echo nl2br(htmlspecialchars($spell->getDescription())); ?>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>




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
                    $currentPv = $monster->getPv();
                    $maxPv = $monster->getPvMax();
                    $healthPercentage = ($maxPv > 0) ? ($currentPv / $maxPv) * 100 : 0; // Calcul du pourcentage
                    ?>
                    <div class="w-full bg-gray-300 rounded-lg h-6">
                        <div class="bg-red-600 h-6 rounded-lg" style="width: <?php echo $healthPercentage; ?>%;"></div>
                    </div>
                    <p class="text-center mt-2 text-lg font-semibold">
                        <?php echo $currentPv . " / " . $maxPv . " PV"; ?>
                    </p>
                    <img src="<?php echo htmlspecialchars($monster->getImage()); ?>" alt="Image du monstre"
                        class="w-full h-auto rounded-lg mb-4">

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
                        <button type="submit" name="chapter_id" value="<?php echo $defeat['chapter_id']; ?>"
                            class="btn btn-primary px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            <?php echo $defeat['link_description']; ?>
                        </button>
                    </form>
                    <?php modifieBase(connexionDb(), "update combat set ongoing = 0 where monster_id = " . $monster->getId() . " and hero_id = " . $user->getHero()->getHeroId() . " and chapter_id = " . $user->getHero()->getChapter()); ?>
                <?php elseif (!$monster->isAlive()): ?>
                    <p>Vous avez vaincu le monstre !</p>
                    <form method="post" action="chapter">
                        <input type="hidden" name="xp" value="<?php echo htmlspecialchars($monster->getExperienceValue()); ?>">
                        <input type="hidden" name="loot" value="<?php $loot = $monster->getLoot();
                        if ($loot)
                            echo htmlspecialchars($monster->getLoot()); ?>">
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
                    modifieBase(connexionDb(), "update combat set ongoing = 0 where monster_id = " . $monster->getId() . " and hero_id = " . $user->getHero()->getHeroId() . " and chapter_id = " . $user->getHero()->getChapter());
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>