<?php include_once('views/template/head.php') ?>

<body class="bg-primary text-textMain font-body min-h-screen">
    <?php include_once('views/template/navbar.php') ?>

    <!-- Logo Under Navbar -->
    <div class="flex justify-center mt-8">
        <img src="/DongeonXplorer/Images/icon/Logo.ico" alt="DungeonXplorer Logo" class="h-64" />
    </div>

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
            <a href="player_selection"
                class="bg-accentGreen hover:bg-accentGold text-textMain py-2 px-4 rounded text-center">
                Commencer l'Aventure
            </a>
        </div>
    </main>
</body>

</html>
