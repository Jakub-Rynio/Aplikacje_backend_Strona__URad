<form method="get" style="display:flex; gap:10px; margin-bottom:20px;">

    <input type="text" name="query" placeholder="Treść / tytuł">

    <input type="text" name="category" placeholder="Kategoria">

    <input type="text" name="topic" placeholder="Temat">

    <button type="submit">Szukaj</button>
</form>
<form method="get" style="margin-bottom:20px;">
<?php
require 'api/functions.php';
require 'api/queries.php';

session_start();

$query    = trim($_GET['query'] ?? "");
$category = trim($_GET['category'] ?? "");
$topic    = trim($_GET['topic'] ?? "");

$admin = 0;
$posts = get_active_posts($query, $category, $topic); // dla zwykłych użytkowników

if (isset($_SESSION['moderator_login'])) {
    $posts = get_all_posts(); // moderator widzi wszystkie posty
    $admin = 1;
}
?>

<?php foreach ($posts as $p): ?>
    <div class="post">

        <h2><?= get_post_title($p); ?></h2>
        <p>Kategoria: <?= get_post_category($p); ?></p>

        <?php if ($img = get_post_image($p)): ?>
            <img src="<?= $img ?>" style="max-width:300px;">
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
