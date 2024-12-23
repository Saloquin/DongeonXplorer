<?php include_once('views/template/head.php') ?>

<body class="bg-primary text-textMain font-body min-h-screen">
    <?php include_once('views/template/navbar.php') ?>
    <?php $user = new User($_SESSION['user']) ?>
    <script>
        function confirmDelete() {
            if (confirm("Êtes-vous sûr de vouloir supprimer votre Hero ? Toutes vos données de sauvegarde seront perdues.")) {
                window.location.href = 'delete_hero';
            }
        }
    </script>
    <main class="p-8 rounded-lg shadow-lg w-full max-w-4xl mx-auto mt-12 bg-secondary text-textMain">
        <h1 class="text-3xl font-title text-center text-accentGold mb-6">Mon Profil</h1>

        <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
            <!-- Avatar Section -->
            
            <div
                class="w-32 h-32 rounded-full bg-gray-700 flex items-center justify-center text-xl text-textMain font-semibold">
                <?php if ($user->getHero() != null): ?>
                    <img src="<?php echo $user->getHero()->getImage(); ?>" alt="" class="w-full h-full rounded-full object-cover">
                <?php else: ?>
                    <span>Avatar</span><!-- Remplace avec une image d'utilisateur si disponible -->
                <?php endif; ?>
            </div>

            <!-- Info Section -->
            <div class="flex-1">
                <h2 class="text-2xl font-semibold mb-4">Bonjour, <span
                        class="text-accentGold"><?php echo $user->getPseudo() ?></span></h2>

                <?php if ($user->possedeHero()): ?>

                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
                        <div class="flex-1">
                            <p class="text-textSecondary mb-4">Information du Hero :</p>
                            <p><span class="font-semibold text-accentGold">Chapitre en cours :</span>
                                <?php echo $user->getHero()->getChapter() != null ? $user->getHero()->getChapter() : '0'; ?>
                            </p>
                            <p><span class="font-semibold text-accentGold">Nom du Hero :</span>
                                <?php echo $user->getHero()->getName() ?></p>
                            <p><span class="font-semibold text-accentGold">Classe :</span>
                                <?php echo $user->getHero()->getClass()->getName() ?></p>
                            <p><span class="font-semibold text-accentGold">Monnaie :</span>
                                <?php echo $user->getHero()->getMoney() != null ? $user->getHero()->getMoney() : '0'; ?>
                            </p>
                            <p><span class="font-semibold text-accentGold">Niveau :</span>
                                <?php echo $user->getHero()->getCurrentLevel() ?></p>
                            <p><span class="font-semibold text-accentGold">Points d'expérience :</span>
                                <?php echo $user->getHero()->getXp() . '/' . $user->getHero()->getXpRequired() ?></p>
                        </div>
                        <div class="flex-1">
                            <p class="text-textSecondary mb-4">Stats du Hero :</p>
                            <p><span class="font-semibold text-accentGold">Vie :</span>
                                <?php echo $user->getHero()->getPv()."/".$user->getHero()->getPvMax() ?></p>
                            <p><span class="font-semibold text-accentGold">Mana :</span>
                                <?php echo $user->getHero()->getMana()."/".$user->getHero()->getManaMax() ?></p>
                            <p><span class="font-semibold text-accentGold">Force :</span>
                                <?php echo $user->getHero()->getStrength() ?></p>
                            <p><span class="font-semibold text-accentGold">Vitesse :</span>
                                <?php echo $user->getHero()->getInitiative() ?></p>
                        </div>
                    </div>

                <?php else: ?>
                    <p>Vous ne possédez pas encore de personnage. <a href="player_selection"
                            class="text-accentGold underline">Cliquez ici pour en créer un</a>.</p>
                <?php endif; ?>
                <div class="space-y-4">
                    <p><span class="font-semibold text-accentGold"></p>
                </div>
            </div>
        </div>
        <?php 
        
        ?>
        <div class="flex justify-between mt-4">
            <a id="openModal" class="bg-accentGold text-textMain py-2 px-4 rounded">Changer Avatar</a>
            <?php if ($user->possedeHero()): ?>
                <a href="javascript:void(0);" onclick="confirmDelete()"
                    class="bg-red-600 text-white py-2 px-4 rounded">Supprimer
                    son hero</a>
            <?php endif; ?>
            <a href="logout" class="bg-red-600 text-white py-2 px-4 rounded">Déconnexion</a>


        </div>
        <!-- Button to open the modal -->


        <!-- The Modal -->
        <div id="myModal" class="modal hidden fixed z-50 inset-0 overflow-y-auto">
            <div class="modal-content bg-secondary p-6 rounded-lg shadow-lg max-w-md mx-auto mt-24">
                <span id="closeModal"
                    class="close text-textMain float-right cursor-pointer bg-accentGold rounded-full px-2">&times;</span>
                <h2 class="text-2xl font-semibold mb-4">Changer Avatar</h2>
                <form id="avatarForm" method="post" action="profil">
                    <label for="avatarUrl" class="block text-textMain mb-2">Lien de l'image:</label>
                    <input type="text" id="avatarUrl" name="avatarUrl"
                        class="w-full p-2 rounded bg-gray-700 text-textMain mb-4" required>
                    <button type="submit" class="bg-accentGold text-textMain py-2 px-4 rounded">Enregistrer</button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('openModal').onclick = function () {
                document.getElementById('myModal').classList.remove('hidden');
            }

            document.getElementById('closeModal').onclick = function () {
                document.getElementById('myModal').classList.add('hidden');
            }

            window.onclick = function (event) {
                if (event.target == document.getElementById('myModal')) {
                    document.getElementById('myModal').classList.add('hidden');
                }
            }
        </script>

    </main>

</body>

</html>