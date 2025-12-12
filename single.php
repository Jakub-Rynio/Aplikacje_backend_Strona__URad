<?php /*
require 'api/queries.php';

$id = (int)($_GET['id'] ?? 0);

$post = get_post_by_id($id);

if (!$post) {
    echo "Nie znaleziono posta";
    exit;
}
?>

<p>Kategoria: <?= get_post_category($post); ?></p>

<?php if ($img = get_post_image($post)): ?>
    <img src="<?= $img ?>" style="max-width:300px;">
<?php endif; ?>
<h1><?= get_post_title($post) ?></h1>
<p><?= get_post_content($post) ?></p>
<?php */ ?>


<?php
require 'api/functions.php';
require 'api/queries.php';

session_start();

$id = (int)($_GET['id'] ?? 0);
$post = get_post_by_id($id);

// Admin może oglądać ukryte
$admin = isset($_SESSION['moderator_login']);

?>

<!DOCTYPE html>

<html lang="pl">

    <?php include "components/head.php"; ?>

    <body class="min-h-screen flex flex-col bg-gray-50">

        <?php include "components/navbar.php"; ?>

            <main class="pt-24 px-6 flex-1">

                <div class="max-w-4xl mx-auto">

                <?php if($admin && isset($post['active']) && !$post['active']): ?>
                    <div class="mb-4 p-3 bg-yellow-100 border-l-4 border-yellow-400 rounded">
                        <p class="text-yellow-800 text-sm">Ten post jest ukryty, ale jako administrator widzisz go.</p>
                    </div>
                <?php elseif((!$admin && isset($post['active']) && !$post['active']) || !$post): ?>
                    <div class="flex items-center justify-center min-h-[60vh] text-center">
                        <div>
                            <h2 class="text-6xl font-bold text-red-500 mb-4">404</h2>
                            <p class="text-gray-700 text-md mb-8">
                                Ten przepis nie istnieje... lub ktoś chce żeby tak myślano.
                            </p>
                            <a class="text-red-400" href="blog.php">Strona główna</a>
                        </div>
                    </div>
                    <?php 
                        http_response_code(404);
                        die(); 
                    ?>
                <?php endif; ?>

                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wide text-red-500"><?= htmlspecialchars(get_post_category($post)); ?></span>
                    <span class="text-xs text-gray-400"><?= (new DateTime(get_post_date($post)))->format("d.m.Y") ?></span>
                </div>

                <h1 class="text-4xl font-bold text-gray-900 mb-4 text-center">
                    <?= htmlspecialchars(get_post_title($post)); ?>
                </h1>

                <?php if($opis = get_post_opis($post)): ?>
                    <p class="text-lg text-gray-600 mb-6"><?= htmlspecialchars($opis); ?></p>
                <?php endif; ?>

                <?php if($img = get_post_image($post)): ?>
                    <img src="<?= htmlspecialchars($img); ?>" alt="Zdjęcie przepisu" class="w-full max-h-[480px] rounded-xl object-cover mb-8">
                <?php endif; ?>

                <article class="prose prose-red max-w-none text-gray-800 leading-relaxed mb-10 text-md lg:text-lg">
                    <?= nl2br(get_post_content($post)); // do ustalenia czy chcemy tu parsować HTML ?>
                </article>

                <?php
                    // Pobranie komentarzy zależnie od roli użytkownika
                    if($admin) {
                        $comments = get_comments_by_post($post['id']);
                    } else {
                        $comments = get_active_comments_by_post($post['id']);
                    }
                ?>

                <section class="mt-16">

                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Komentarze</h2>

                    <?php if(empty($comments)): ?>
                        <p class="text-gray-500 text-md mb-8">Brak komentarzy. Bądź pierwszy!</p>
                    <?php endif; ?>

                    <div class="space-y-6">

                        <?php foreach($comments as $comment): ?>

                            <div class="bg-red-50 rounded-xl p-5 my-3">

                                <div class="flex items-center justify-between mb-2">

                                    <span class="font-semibold text-gray-800 text-sm md:text-base">
                                        <?= htmlspecialchars(get_comment_author($comment)); ?>
                                    </span>

                                    <span class="text-xs text-gray-400">
                                        <?= htmlspecialchars(get_comment_date($comment)); ?>
                                    </span>

                                </div>

                                <p class="text-gray-700 whitespace-pre-line mb-3">
                                    <?= htmlspecialchars(get_comment_content($comment)); ?>
                                </p>

                                <?php if($admin && isset($comment['active']) && !$comment['active']): ?>
                                    <p class="text-xs text-gray-500">Ten komentarz jest ukryty (administrator widzi).</p>
                                <?php endif; ?>

                                <?php if($admin): ?>
                                    <div class="mt-3">
                                        <?php active_switch_coment($post, $comment); ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </section>

                <section class="mt-16 mb-2 max-w-4xl mx-auto">

                    <h3 class="text-2xl font-semibold text-gray-900 mb-5">Dodaj komentarz</h3>

                    <?php coment_form($post); ?>

                </section>

            </div>

        </main>

        <?php include "components/footer.php"; ?>

    </body>

</html>