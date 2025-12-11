<nav class="fixed top-0 left-0 w-full bg-red-500 border-gray-300 z-20 shadow-md">

    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3">
            <span class="font-sans self-center text-2xl font-semibold whitespace-nowrap text-white mt-[-2px] text-shadow-xl">Najlepsze przepisy</span>
        </a>

        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-100 rounded-lg md:hidden hover:bg-red-300 focus:outline-none" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Rozwiń menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-red-300 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                <li class="m-auto">
                    <a href="blog.php#recipes" class="block py-2 px-3 text-gray-100 rounded-sm md:border-0 hover:text-white md:p-0 text-lg">Przepisy</a>
                </li>
                <?php if(isset($_SESSION['moderator_login'])): ?>
                    <li class="m-auto">
                        <a href="control_panel.php" class="block py-2 px-3 text-gray-100 rounded-sm md:border-0 hover:text-white md:p-0 text-lg">Panel administratora</a>
                    </li>
                <?php endif; ?>
                <li class="m-auto">
                    <?php if(isset($_SESSION['moderator_login'])): ?>
                        <a href="api/logout.php" class="block py-2 px-3 text-gray-100 rounded-sm md:border-0 hover:text-white md:p-0 text-lg">Wyloguj (<?php echo $_SESSION['moderator_login'] ?>)</a>
                    <?php else: ?>
                        <a href="login_form.php" class="block py-2 px-3 text-gray-100 rounded-sm md:border-0 hover:text-white md:p-0 text-lg">Logowanie</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>

    </div>

</nav>