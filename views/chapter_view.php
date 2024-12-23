<?php include_once('views/template/head.php') ?>

<body class="bg-primary text-textMain font-body min-h-screen">
    <?php 
        include_once('views/template/navbar.php'); 
        
        $user = new User($_SESSION['user']);
        $chapter = new Chapter($user->getHero()->getChapter());
    ?>

    <!-- Titre -->
    <h1 class="text-4xl md:text-5xl font-bold text-center mb-6">
        <?php echo htmlspecialchars($chapter->getTitle()); ?>
    </h1>

    <!-- Image -->
    <img src="<?php echo htmlspecialchars($chapter->getImage()); ?>" alt="Image de chapitre" class="w-full max-w-xl mx-auto mb-6">

    <!-- Description -->
    <p class="text-lg md:text-xl p-4 text-justify mb-6">
        <?php echo nl2br(htmlspecialchars($chapter->getDescription())); ?>
    </p>

    <!-- Choix -->
    <h2 class="text-2xl font-semibold mb-4">Choisissez votre chemin :</h2>

    <form method="post" action="chapter">
        <?php foreach ($chapter->getChoices() as $choice): ?>
            <div class="mb-4">
                <button type="submit" name="chapter_id" value="<?php echo htmlspecialchars($choice['chapter_id']); ?>" class="btn btn-primary px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    <?php echo htmlspecialchars($choice['link_description']); ?>
                </button>
            </div>
        <?php endforeach; ?>
    </form>
</body>

</html>
