<?php include_once('views/template/head.php') ?><body>
    <?php include_once('views/template/navbar.php') ?>
    <h1><?php echo $chapter->getTitle(); ?></h1>
    <img src="<?php echo $chapter->getImage(); ?>" alt="Image de chapitre" style="max-width: 100%; height: auto;">
    <p><?php echo $chapter->getDescription(); ?></p>

    <h2>Choisissez votre chemin:</h2>
    <ul>
        <?php foreach ($chapter->getChoices() as $choice) : ?>
            <li>
                <a href="/DongeonXplorer/chapter/<?php echo $choice['chapter']; ?>">
                    <?php echo $choice['text']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>