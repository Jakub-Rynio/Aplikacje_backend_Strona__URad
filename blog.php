<?php
    require 'api/functions.php';
    require 'api/queries.php';

    session_start();

    $zapytanie = trim($_GET['zapytanie'] ?? "");
    $kategoria = trim($_GET['kategoria'] ?? "");
    $tytul     = trim($_GET['tytul'] ?? "");
    $autor     = trim($_GET['autor'] ?? "");

    $admin = false;
    if (isset($_SESSION['moderator_login'])) {
        $admin = true;
    }
    $posts = get_posts($admin, $zapytanie, $kategoria, $tytul, $autor);
?>

<!DOCTYPE html>

<html lang="pl">

    <?php include "components/head.php" ?>

    <body class="min-h-screen flex flex-col">

        <?php include "components/navbar.php" ?>

        <main class="pt-20 flex-1">

            <section class="pt-5">
        
                <form method="get" class="w-full max-w-5xl mx-auto px-4 flex flex-col md:flex-row md:flex-nowrap gap-3 mb-8 justify-center items-center">

                    <input type="text" name="zapytanie" placeholder="Treść" class="border border-gray-300 rounded-lg px-3 h-12 w-full md:w-auto flex-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500" />
                    <input type="text" name="kategoria" placeholder="Kategoria" class="border border-gray-300 rounded-lg px-3 h-12 w-full md:w-auto flex-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500" />
                    <input type="text" name="tytul" placeholder="Tytuł" class="border border-gray-300 rounded-lg px-3 h-12 w-full md:w-auto flex-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500" />
                    <input type="text" name="autor" placeholder="Autor" class="border border-gray-300 rounded-lg px-3 h-12 w-full md:w-auto flex-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500" />
                    
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 h-12 rounded-lg w-full md:w-auto transition flex items-center justify-center" aria-label="Wyszukaj">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    </button>
                    
                </form>

            </section>

            <section id="recipes" class="py-6 px-6 md:px-12">

                <div class="max-w-4xl mx-auto mb-8 text-center">
                    <h2 class="text-4xl font-bold text-red-500 mb-5">Nasze przepisy</h2>
                    <p class="text-gray-700 text-md md:text-lg">Wybierz coś pysznego - prosty obiad, leniwe śniadanie albo deser na poprawę humoru.</p>
                </div>

                <div class="max-w-4xl mx-auto space-y-8">

                <?php if(empty($posts)): ?>
                    <p class="text-center text-gray-500 text-lg py-10">Nie znaleziono żadnych wyników.</p>
                <?php endif; ?>

                    <?php foreach($posts as $post): ?>
                        <a href="single.php?id=<?= get_post_id($post) ?>" class="block">
                            <article class="bg-red-50 rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row hover:bg-red-100">
                                <div class="h-56 md:w-64 bg-cover bg-center m-1 rounded-lg bg-[url(<?php echo get_post_image($post) ?>)]"></div>
                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-red-500"><?= get_post_category($post); ?></span>
                                        <span class="text-xs text-gray-400"><?php echo (new DateTime(get_post_date($post)))->format("d.m.Y") ?></span>
                                    </div>
                                    <h3 class="text-2xl font-semibold text-gray-900 mb-2"><?= get_post_title($post); ?></h3>
                                    <p class="text-gray-600 text-sm flex-1"><?php echo get_post_opis($post) ?></p>
                                </div>
                            </article>
                        </a>

                    <?php endforeach; ?>

                </div>

            </section>

            <?php /* ?>
            <?php foreach ($posts as $p): ?>
                <div class="post">

                    <h2>
                        <a href="single.php?id=<?= (int)$p['id'] ?>">
                            <?= get_post_title($p); ?>
                        </a>
                    </h2>
                    <p>Kategoria: <?= get_post_category($p); ?></p>

                    <?php if ($img = get_post_image($p)): ?>

                        <a href="single.php?id=<?= (int)$p['id'] ?>">
                            <img src="<?= $img ?>" style="max-width:300px;">
                        </a>
                    <?php endif; ?>

                    <p><?= get_post_content($p); ?></p>

                    <!-- Panel moderatora: zmiana statusu -->
                    <?php if ($admin): ?>
                        <?php active_switch($p); ?>
                    <?php endif; ?>

                    <!-- Komentarze do posta -->
                    <?php 
                        if($admin){$comments = get_comments_by_post($p['id']);} 
                        else{
                            $comments = get_active_comments_by_post($p['id']);
                        };
                        foreach ($comments as $c): ?>
                            <div class="comment" style="margin-left:20px; border-left:2px solid #ccc; padding-left:10px;">
                                <p><strong><?= get_comment_author($c); ?></strong> | <?= get_comment_date($c); ?></p>
                                <p><?= get_comment_content($c); ?></p>
                            </div>
                            
                    <?php if ($admin): ?>
                        <?php active_switch_coment($c); ?>
                    <?php endif; ?>
                    <?php 
                        endforeach; ?>


                    <!-- Formularz dodawania komentarza -->
                    <?php coment_form($p); ?>

                    <hr>
                </div>
            <?php endforeach; ?>
        <?php */ ?>

        </main>

        <?php include "components/footer.php" ?>

    </body>

</html>