<?php
if (!isset($_SESSION['user'])) {
    header('Location: login');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Profil de l'utilisateur</h1>
    </header>
    <main>
        <section>
            <h2>Informations personnelles</h2>
            <p>Nom: <?php echo $_SESSION['user']; ?></p>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 DongeonXplorer</p>
    </footer>
</body>
</html>


