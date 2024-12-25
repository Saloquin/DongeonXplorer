<?php include_once('views/template/head.php') ?>

<body class="bg-primary text-white">

    <?php include_once('views/template/navbar.php') ?>

    <!-- Espace pour que la navbar ne cache pas le contenu -->
    <div class="pt-20">
        <!-- Ajout de padding-top pour que le contenu ne soit pas caché sous la navbar -->

        <!-- Formulaire de connexion -->
        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-gray-300 border-2 border-gray-600 rounded-lg shadow-xl p-6">
                <!-- Title -->
                <h2 class="text-3xl font-bold text-center text-yellow-500 mb-4">Dongeon Xplorer</h2>
                <p class="text-center text-sm text-gray-400 italic mb-6">Créer un compte pour commencer votre aventure
                </p>
                <p class="text-center text-sm text-red-400 italic mb-6">
                    <?php if (isset($_SESSION['error'])) {
                        //echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    } ?>
                </p>

                <!-- Registration Form -->
                <form action="register" method="POST" class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-400 mb-1">Nom d'utilisateur
                            :</label>
                        <input type="text" id="username" name="username" required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-400 mb-1">Mot de passe
                            :</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                    </div>

                    <!-- Buttons -->
                    <div class="flex space-x-4 mt-6 justify-center">
                        <button type="submit"
                            class="bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded hover:bg-yellow-600 focus:outline-none">
                            S'inscrire
                        </button>
                        <button type="button"
                            class="bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded hover:bg-gray-600 focus:outline-none">
                            Annuler
                        </button>
                    </div>
                </form>

                <!-- Subtitle or Decorative Text -->
                <p class="mt-8 text-center text-xs text-gray-400 tracking-widest">Création du compte</p>
                <p class="mt-8 text-center text-xs text-gray-400 tracking-widest">Vous possedez déjà un compte <a
                        href="login" class="text-accentGold underline">Cliquez ici pour vous
                        connecter</a></p>
            </div>
        </div>
    </div>
</body>

</html>