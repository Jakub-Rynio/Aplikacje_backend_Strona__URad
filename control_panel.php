<?php
require 'api/queries.php';

session_start();

if(!isset($_SESSION["moderator_login"])){
    header("Location: ../login_form.php");
    exit;
}

if(!isset($_SESSION["csrf_token"])){
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

$posts = get_posts(true);
?>

<!DOCTYPE html>

<html lang="pl">

    <?php include "components/head.php" ?>

    <body class="min-h-screen flex flex-col bg-gray-50 text-gray-800">

        <?php include "components/navbar.php" ?>

        <main class="pt-20 flex-1 px-4 md:px-8">

            <div class="max-w-4xl mx-auto my-5">

                <div class="my-5">
                    <h1 class="text-2xl font-bold text-center">Panel administratora</h1>
                    <p class="text-sm text-gray-500 text-center">Witaj, <?php echo htmlspecialchars($_SESSION["moderator_login"]); ?></p>
                </div>

                <div class="bg-red-50 rounded-2xl shadow-md overflow-hidden">
                    
                    <div class="border-b border-red-200">
                        <div class="p-3 md:p-4">
                            <ul class="flex gap-2" role="tablist" data-tabs-toggle="#tab-panels" data-tabs-active-classes="text-red-500 border-b-2 border-red-500" data-tabs-inactive-classes="text-gray-500 hover:text-gray-700">
                                
                                <li role="presentation">
                                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-t-xl text-sm font-medium border-b-2 border-transparent no-underline focus:outline-none focus:ring-0" data-tabs-target="#panel-list" type="button" role="tab">Lista przepisów</button>
                                </li>

                                <li role="presentation">
                                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-t-xl text-sm font-medium border-b-2 border-transparent no-underline focus:outline-none focus:ring-0" data-tabs-target="#panel-post" type="button" role="tab">Dodaj przepis</button>
                                </li>

                                <li role="presentation">
                                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-t-xl text-sm font-medium border-b-2 border-transparent no-underline focus:outline-none focus:ring-0" data-tabs-target="#panel-users" type="button" role="tab">Dodaj moderatora</button>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div id="tab-panels" class="p-6">

                        <!-- Panel z lista przepisów -->

                        <section id="panel-list" role="tabpanel" class="hidden tab-panel">
                            <h2 class="text-lg font-semibold mb-4">Lista przepisów</h2>

                            <div class="space-y-4">

                                <?php foreach($posts as $post): ?>
                                    <div class="p-4 bg-white rounded-lg shadow border border-gray-200 flex items-center justify-between">
                                        
                                        <div>
                                            <h3 class="text-md font-semibold text-gray-800">
                                                <a href="single.php?id=<?php echo $post['id'] ?>"><?php echo htmlspecialchars($post['tytul']); ?></a>
                                            </h3>
                                            <p class="text-sm text-gray-500">ID: <?php echo (int)$post['id']; ?></p>
                                        </div>

                                        <form method="post" action="api/update_post_status.php" class="flex items-center gap-3">

                                            <input type="hidden" name="post_id" value="<?php echo (int)$post['id']; ?>">
                                            <input type="hidden" name="active" value="<?php echo $post['active'] ? 0 : 1; ?>">

                                            <?php if($post['active']): ?>
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-red-500 hover:bg-red-600 text-white text-sm font-medium transition">Ukryj</button>
                                            <?php else: ?>
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-gray-400 hover:bg-gray-500 text-white text-sm font-medium transition">Pokaż</button>
                                            <?php endif; ?>

                                        </form>

                                    </div>

                                <?php endforeach; ?>

                                <?php if(empty($posts)): ?>
                                    <div class="p-6 bg-white rounded-lg border text-center text-gray-500">Brak przepisów do wyświetlenia.</div>
                                <?php endif; ?>

                            </div>
                        </section>

                        <!-- Panel dodawania przepisu -->

                        <section id="panel-post" role="tabpanel" class="tab-panel">
                            
                            <h2 class="text-lg font-semibold mb-4">Dodaj przepis</h2>

                            <form id="add-post-form" method="post" action="/api/add_post.php" enctype="multipart/form-data" class="space-y-4">
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tytuł</label>
                                    <input type="text" name="tytul" required minlength="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kategoria</label>
                                    <input type="text" name="kategoria" required minlength="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Zdjęcie</label>
                                    <input id="zdjecie" type="file" name="zdjecie" accept="image/*" required class="mt-1 block w-full text-sm text-gray-600">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Treść</label>
                                    <textarea name="content" required minlength="5" rows="6" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Opis (opcjonalnie)</label>
                                    <input type="text" name="opis" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                                </div>

                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">

                                <div class="pt-2">
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-lg transition">Dodaj przepis</button>
                                </div>

                            </form>

                        </section>

                        <!-- Panel dodawania moderatora -->

                        <section id="panel-users" role="tabpanel" class="tab-panel">

                            <h2 class="text-lg font-semibold mb-4">Dodaj moderatora</h2>

                            <form method="post" action="/api/add_user.php" class="space-y-4">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Login</label>
                                    <input type="text" name="login" required minlength="3" maxlength="20" pattern="^[a-zA-Z0-9_]{3,20}$" title="Login może mieć 3–20 znaków i zawierać tylko litery, cyfry oraz podkreślenie (_)" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Hasło</label>
                                    <input type="password" name="haslo" required minlength="8" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
                                </div>

                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">

                                <div class="pt-2">
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-lg transition">Dodaj moderatora</button>
                                </div>
                            </form>

                        </section>

                    </div>
                </div>

            </div>
            
        </main>

        <?php include "components/footer.php" ?>

    </body>

</html>