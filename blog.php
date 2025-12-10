<form method="get" style="display:flex; gap:10px; margin-bottom:20px;">

    <input type="text" name="zapytanie" placeholder="Treść">

    <input type="text" name="kategoria" placeholder="Kategoria">

    <input type="text" name="tytul" placeholder="Tytul">

    <input type="text" name="autor" placeholder="Autor">

    <button type="submit">Szukaj</button>
</form>

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
