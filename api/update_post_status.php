<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['moderator_login'])) {
    header('Location: ../login_form.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../posts.php');
    exit;
}

$post_id = (int)$_POST['post_id'];
$active = (int)$_POST['active'];

$stmt = $pdo->prepare("UPDATE przepisy SET active = :active WHERE id = :id");
$stmt->execute([
    ':active' => $active,
    ':id' => $post_id
]);

header('Location: ../blog.php');
exit;
