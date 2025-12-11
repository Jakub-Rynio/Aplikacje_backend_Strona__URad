<?php
session_start();

if(isset($_SESSION['moderator_login'])) header('Location: control_panel.php'); // Już zalogowany

// Generowanie tokenu CSRF, jeśli go nie ma
if(!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>

<html lang="pl">

    <?php include "components/head.php" ?>

    <body class="min-h-screen flex flex-col">

        <?php include "components/navbar.php" ?>

        <main class="flex-1 flex items-center justify-center px-6 min-h-0">

            <section class="flex items-center justify-center flex-1 px-6">

                <div class="w-full max-w-md bg-red-50 rounded-xl shadow-lg p-8 text-center">

                    <h2 class="text-4xl font-bold text-red-500 mb-2">Zaloguj się</h2>
                    <p class="text-gray-700 text-md mb-6">Logowanie do panelu administratora.</p>

                    <form method="post" action="api/login.php" class="space-y-5 text-left">

                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">Login</label>
                            <input type="text" name="login" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">Hasło</label>
                            <input type="password" name="haslo" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                        </div>

                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-lg shadow transition">Zaloguj się</button>

                    </form>

                </div>

            </section>

        </main>

        <?php include "components/footer.php" ?>

    </body>

</html>