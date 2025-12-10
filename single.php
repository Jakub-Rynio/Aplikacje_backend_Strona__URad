<?php
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
