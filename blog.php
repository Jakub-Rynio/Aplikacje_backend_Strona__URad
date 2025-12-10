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

    <body>

        <?php include "components/navbar.php" ?>

        <main class="pt-20">

            <section> <!-- TODO -->
        
                <form method="get" style="display:flex; gap:10px; margin-bottom:20px;">
                    <input type="text" name="zapytanie" placeholder="Treść">
                    <input type="text" name="kategoria" placeholder="Kategoria">
                    <input type="text" name="tytul" placeholder="Tytul">
                    <input type="text" name="autor" placeholder="Autor">
                    <button type="submit">Szukaj</button>
                </form>

            </section>

            <section id="recipes" class="py-10 px-6 md:px-12">

                <div class="max-w-4xl mx-auto mb-8 text-center">
                    <h2 class="text-4xl font-bold text-red-500 mb-5">Nasze przepisy</h2>
                    <p class="text-gray-700 text-md md:text-lg">Wybierz coś pysznego - prosty obiad, leniwe śniadanie albo deser na poprawę humoru.</p>
                </div>

                <div class="max-w-4xl mx-auto space-y-8">

                    <?php foreach ($posts as $post): ?>

                        <article class="bg-red-50 rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row">
                            <div class="h-56 md:w-64 bg-cover bg-center bg-[url(<?php echo get_post_image($post) ?>)]"></div>
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-red-500"><?= get_post_category($post); ?></span>
                                    <span class="text-xs text-gray-400">data publikacji</span>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2"><a href="single.php?id=<?= (int)$post['id'] ?>"><?= get_post_title($post); ?></a></h3>
                                <p class="text-gray-600 text-sm flex-1">opis</p>
                                <a href="single.php?id=<?= (int)$post['id'] ?>" class="mt-4 inline-block text-sm font-semibold text-red-500 hover:text-red-700">Czytaj przepis →</a>
                            </div>
                        </article>

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