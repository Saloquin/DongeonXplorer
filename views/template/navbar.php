<nav class="bg-navbarDark border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="home" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/DongeonXplorer/Images/icon/Logo.png" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">DungeonXplorer</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-accenGold rounded-lg md:hidden bg-primary focus:outline-none "
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-primary rounded-lg bg-navbarDark md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-navbarDark">
                <?php if (!isset($_SESSION['user'])): ?>
                    <li>
                        <a href="register"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-primary md:hover:bg-primary md:border-0 hover:text-accentGold md:p-0">S'inscrire</a>
                    </li>
                    <li>
                        <a href="login"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-primary md:hover:bg-primary md:border-0 hover:text-accentGold md:p-0">Se
                            connecter</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="profil"
                            class="block py-2 px-3 text-gray-300 rounded hover:bg-primary md:hover:bg-primary md:border-0 hover:text-accentGold md:p-0">Profil</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.querySelector('[data-collapse-toggle="navbar-default"]');
        const navbar = document.getElementById('navbar-default');

        toggleButton.addEventListener('click', function () {
            navbar.classList.toggle('hidden');
        });
    });
</script>