<!DOCTYPE html>

<html lang="pl">

    <?php include "components/head.php" ?>

    <body class="min-h-screen flex flex-col">

        <?php include "components/navbar.php" ?>

        <main class="flex-1 flex items-center justify-center px-6 min-h-0">

            <section class="flex items-center justify-center flex-1 px-6 text-center">

                <div>

                    <h2 class="text-4xl font-bold text-red-500 mb-4">Operacja udała się</h2>
                    <p class="text-gray-700 text-md mb-8">
                        <?php if(isset($_GET["id"]) && $_GET["id"] == 1): ?>
                            Pomyślnie utworzono nowego użytkownika.
                        <?php elseif(isset($_GET["id"]) && $_GET["id"] == 2): ?>
                            Pomyślnie dodano nowy przepis.
                        <?php endif; ?>
                    </p>

                    <a class="text-red-400" href="blog.php">Strona główna</a>

                </div>

            </section>

        </main>

        <?php include "components/footer.php" ?>

    </body>

</html>